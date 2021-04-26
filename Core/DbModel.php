<?php

namespace App\Core;

    abstract class DbModel extends Model
    {
        abstract public function tableName(): string;
        abstract public function attributes(): array;
        abstract public function primaryKey(): string;

        public function save(): bool
        {
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(static fn($attr) => ":$attr", $attributes);
            $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ")
        VALUES(" . implode(',', $params) . ")");
            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
            $statement->execute();
            return true;
        }

        public function findOne($where)
        {
            $tableName = static::tableName();
            $attributes = array_keys($where);
            $sql = implode('AND ', array_map(static fn($attr) => "$attr = :$attr", $attributes));
            $statement = self::prepare('SELECT * FROM ' . $tableName . ' WHERE ' . $sql);
            foreach ($where as $field => $value) {
                $statement->bindValue(":$field", $value);
            }

            $statement->execute();
            return $statement->fetchObject(static::class);
        }

        public static function prepare($sql)
        {
            return Application::$app->db->pdo->prepare($sql);
        }
    }
