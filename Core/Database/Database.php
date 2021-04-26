<?php

namespace App\Core\Database;

use App\Core\Application;
use App\Core\Debug;
use PDO;
use PDOException;

class Database
{
    public PDO $pdo;
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // prevent emulation of prepared statements
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    /*protected static function connect(string $servername, string $username, string $password, string $dbname): PDO
    {
        if (!isset(self::$connect)) {
            try {
                self::$connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // default the PDO fetch mode to assoc
                self::$connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        return self::$connect;
    }*/

    public function applyMigrations(): void
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_PATH . '/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        //Debug::showArrayDump($toApplyMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            require_once Application::$ROOT_PATH . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration" . PHP_EOL);
            $instance->up();
            $this->log("Applied migration $migration" . PHP_EOL);
            $newMigrations[] = $migration;
            //Debug::varDump($className);
        }
        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log('All migration are applied');
        }
    }

    public function createMigrationsTable(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;
        ");
    }

    public function getAppliedMigrations(): array
    {
        $statement = $this->pdo->query("SELECT migration FROM migrations");
        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations): void
    {
        $str = implode(",", array_map(static fn($m) => "('$m')", $migrations));
        $this->pdo->exec("INSERT INTO migrations (migration) VALUES
            $str
        ");
    }

    protected function log(string $message): void
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message;
    }
}
