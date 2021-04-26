<?php

/*use App\Widget\Div;
use App\Widget\Form\Button;
use App\Widget\Form\SearchInput;
use App\Widget\Nav\Anchor;
use App\Widget\Nav\ListItem;
use App\Widget\Nav\Nav;
use App\Widget\Nav\UnorderedList;
use App\Widget\TagBuilder;*/
use App\Core\Debug;
use App\Widget\Bootstrap\BootstrapMenu;

function Menu(): string
{
    //$menu = new Nav();
    $menu = new BootstrapMenu(
        [
            'Home I:fas fa-home' => 'home',
            'Inscription I:fas fa-user' => 'register',
            'Conexion I:fas fa-user' => 'login',
            'Contact I:fas fa-phone' => 'contact',
            'Test I:fas fa-check' => [
                'Test 1' => 'test',
                'Test 2' => '#',
                'Test 3 I:fas fa-info' => '#'
            ]
        ],
        'Widgets'
    );
    //Debug::varDump(true, $menu->ul->getChilds());
    /*$menu->addClass('navbar navbar-expand-lg navbar-light bg-light fixed-top');
    $menu_container = $menu->addElement(new Div('container'));

    $brand = $menu_container->addElement(TagBuilder::createNormalElement('a'));
    $brand->addText('Widget');
    $brand->setAttributes(['class' => 'navbar-brand', 'href' => '/']);

    $toggler = $menu_container->addElement(TagBuilder::createNormalElement('button'));
    $toggler->setAttributes([
        'class' => 'navbar-toggler',
        'type' => 'button',
        'data-mdb-toggle' => 'collapse',
        'data-mdb-target' => '#navbarNav',
        'aria-controls' => 'navbarNav',
        'aria-expanded' => 'false',
        'aria-label' => 'Toggle navigation'
    ]);
    $toggler->addElement(TagBuilder::createNormalElement('i'))->addClass('fas fa-bars');

    $collapse = $menu_container->addElement(new Div('collapse navbar-collapse justify-content-end'));
    $collapse->setAttribute('id', 'navbarNav');
    $ul = new UnorderedList('navbar-nav mb-2 mb-lg-0');
    $collapse->addElement($ul);

    /* home link start 

    $homeAnchor = new Anchor('Home', 'home', 'fas fa-home');
    $homeAnchor->setAttributes(['class' => 'nav-link active', 'aria-current' => 'page']);
    $home = new ListItem('nav-item');
    $home->addElement($homeAnchor);

    /* home link end */

    /* register link start 

    $registerAnchor = new Anchor('Inscription', 'register', 'fas fa-user');
    $registerAnchor->addClass('nav-link');
    $register = new ListItem('nav-item');
    $register->addElement($registerAnchor);

    /* register link end */

    /* register link start 

    $loginAnchor = new Anchor('Connexion', 'login', 'fas fa-user');
    $loginAnchor->addClass('nav-link');
    $login = new ListItem('nav-item');
    $login->addElement($loginAnchor);

    /* register link end */

    /* contact link start 

    $contactAnchor = new Anchor('Contact', 'contact', 'fas fa-phone');
    $contactAnchor->addClass('nav-link');
    $contact = new ListItem('nav-item');
    $contact->addElement($contactAnchor);
    $contact->insertBefore($home);
    $contact->insertBefore($register);
    $contact->insertBefore($login);

    // Test link start

    $testAnchor = new Anchor('Test', 'test', 'fas fa-check');
    $testAnchor->addClass('nav-link');
    $test = new ListItem('nav-item');
    $test->addElement($testAnchor);
    $contact->insertAfter($test);

    /* contact link end 

    $ul->addElements([$contact]);*/
    return $menu->render();
}
