<?php

use App\Core\View;
use App\Widget\Div;
use App\Widget\HtmlPage;

$testPage = new HtmlPage();

$testPage->addMetaTag('description', 'width=device-width, initial-scale=1, shrink-to-fit=no');
$testPage->addMetaTag('description', 'Testing my mvc Framework');
$testPage->addLinks([
    'stylesheet' => [
        'vendor/mdb/css/mdb.min.css',
        'vendor/fontawesome5/css/all.min.css',
        'css/main.css'
    ]
]);
$testPage->addScripts([
    'text/javascript' => [
        'vendor/mdb/js/mdb.min.js',
        'vendor/fontawesome5/js/all.min.js'
    ]
]);

$body = $testPage->getBody();
$body->addClass("bg-dark");
$body->addText(Menu(), 'first');

$body->addElement(new Div('container mt-4 pt-5 mb-4 pb-5'))->addText(View::getContent());

$body->addText(Footer());
$testPage->print();
