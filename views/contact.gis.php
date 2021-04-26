<?php

use App\Widget\Bootstrap\BootstrapButton;
use App\Widget\Bootstrap\BootstrapInput;
use App\Widget\Div;
use App\Widget\Form\Form;
use App\Widget\TagBuilder;

/* row creation */
$row = new Div('row justify-content-around');

/* form title creation and insertion in row */

$h1 = $row->addElement(TagBuilder::createNormalElement('h1'));
$h1->addText('Contactez-Nous');
$h1->addClass('text-center');

/* form creation */

$form = new Form('', 'post');
$form->addClass('col-lg-6');

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

/* message field */

$message = new BootstrapInput(
    'textarea',
    'message',
    'message',
    'Message',
    'fas fa-envelope'
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
        [$prenom, $nom, $email, $message]
    );
}

/* Adding fields and button to form */

$form->addElements([$prenom, $nom, $email, $message, $button]);
$row->addElement($form);

/* Rendering the row */
echo $row->render();


/*$page = new HtmlPage();
$indenter = new Indenter();
try {
    $indented = $indenter->indent($page->renderPage());
} catch (\Gajus\Dindent\Exception\RuntimeException $e) {
    echo $e->getMessage();
}
file_put_contents(__DIR__ . '../test.html', $indented);*/
