<?php

use App\Core\Application;
use App\Widget\Bootstrap\BootstrapButton;
use App\Widget\Bootstrap\BootstrapInput;
use App\Widget\Div;
use App\Widget\Form\Form;
use App\Widget\TagBuilder;

$row = new Div('row justify-content-around');

$form = new Form('', 'post', 'col-lg-6');
//\App\Core\Debug::varDump(false, Application::$app->user);
/*## Form element creation ##*/

/* email field */

$email = new BootstrapInput(
    'email',
    'email',
    'email',
    'Email',
    'fab fa-google text-danger'
);

/* password field */

$password = new BootstrapInput(
    'password',
    'password',
    'password',
    'Mot de Passe',
    'fas fa-lock'
);

/* btn element */

$button = new BootstrapButton(
    'submit',
    'login',
    'Connexion',
    'primary mt-4',
    'default',
    'fas fa-sign-in-alt'
);

/* Validation */
if (isset($model)) {
    BootstrapInput::addValidations(
        $model,
        [$email, $password]
    );
}

/* Adding fields and button to form */

$form->addElements([$email, $password, $button]);

/* Adding form title and form to row */

$row->addElements([
    TagBuilder::createNormalElement('h1')
        ->addText('Connexion')
        ->addClass('text-center'),
    $form
]);

/* handling Session flash message on success */

if (Application::$app->session->getFlash('success')) {
    $alert = new Div('alert alert-success');
    $alert->addText(Application::$app->session->getFlash('success'));
    echo $alert->render();
}
/* Rendering the row */
echo $row->render();
