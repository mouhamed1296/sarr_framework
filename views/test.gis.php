<?php

use App\Widget\Div;
use App\Widget\Form\Button;
use App\Widget\Form\Form;
use App\Widget\Form\TelInput;
use App\Widget\Form\TextInput;


echo 'Hello  world I am a PHP programmer';

$div = new Div('row justify-content-around');
$form = $div->addElement(new Form('', 'post'));
$form->setAttributes([
    'class' => 'col-lg-6'
]);
$textInput = $form->addElement(new TextInput('test', 'test'));
$textInput->setAttributes([
    'value' => 'Testing',
    'class' => 'form-control'
]);
$form->addElement(new TelInput('test1', 'test1'))->setAttribute('value', 'testing1');
$form->removeChild('name', 'test1');

$form->addElement(new Button('send', 'submit'))
    ->setAttributes([
    'class' => 'btn btn-sm btn-primary mt-3'
]);

echo $div->render();
