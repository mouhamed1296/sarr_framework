<?php

use App\Core\Application;
use App\Widget\Bootstrap\BootstrapButton;
use App\Widget\Bootstrap\BootstrapInput;
use App\Widget\Div;
use App\Widget\Form\Form;
use App\Widget\TagBuilder;

$row = new Div('row justify-content-around');

$form = new Form('', 'post', 'col-lg-6');

/*## Form element creation ##*/

/* prenom field */

$prenom = new BootstrapInput(
    'text',
    'firstname',
    'prenom',
    'Prénom',
    'fas fa-user text-primary'
);

/* nom field */

$nom = new BootstrapInput(
    'text',
    'lastname',
    'nom',
    'Nom',
    'fas fa-user text-success'
);

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
    'Password',
    'fas fa-lock'
);

/* password field */

$passwordConfirm = new BootstrapInput(
    'password',
    'passwordConfirm',
    'passwordConfirm',
    'Confirm Password',
    'fas fa-lock'
);

/* btn element */

$button = new BootstrapButton(
    'submit',
    'send',
    'Envoyer',
    'primary mt-3',
    'default',
    'fas fa-paper-plane'
);

/* Validation */

if (isset($model)) {
    BootstrapInput::addValidations(
        $model,
        [$prenom, $nom, $email, $password, $passwordConfirm]
    );
}

/* Adding fields and button to form */

$form->addElements([$prenom, $nom, $email, $password, $passwordConfirm, $button]);

$row->addElements([
    TagBuilder::createNormalElement('h1')
        ->addText('Inscription')
        ->addClass('text-center'),
    $form
]);

if (Application::$app->session->getFlash('success')) {
    $alert = new Div('alert alert-success');
    $alert->addText(Application::$app->session->getFlash('success'));
    echo $alert->render();
}

/* Rendering the row */
echo $row->render();

