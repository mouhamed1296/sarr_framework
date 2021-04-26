<?php

/**
 * User: Mamadou Sarr
 * Date: 25/12/2020
 * Time: 21:35
 */

namespace App\Core;

use App\Core\Database\Database;

class Application
{
    public static string $ROOT_PATH;
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?DbModel $user;

    public static Application $app;
    public BaseController $baseController;

    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_PATH = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    /**
     * @return BaseController
     */
    public function getBaseController(): BaseController
    {
        return $this->baseController;
    }

    /**
     * @param BaseController $baseController
     * @return void
     */
    public function setBaseController(BaseController $baseController): void
    {
        $this->baseController = $baseController;
    }

    /**
     * run
     *
     * @return void
     */
    public function run(): void
    {
        echo $this->router->resolve();
    }

    public function login(DbModel $user): bool
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout(): void
    {
        $this->user = null;
        $this->session->remove('user ');
    }
}
