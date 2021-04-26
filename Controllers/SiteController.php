<?php

namespace App\Controllers;

use App\Core\BaseController;

class SiteController extends BaseController
{
    public function contact()
    {
        $this->setLayout('main');
        return $this->render("contact");
    }

    public function about()
    {
        $this->setLayout('main');
        return $this->render("about");
    }

    public function test()
    {
        $this->setLayout('test');
        return $this->render("test");
    }
    public function home()
    {
        $this->setLayout('main');
        return $this->render("home");
    }
}
