<?php

use App\Widget\{
    Form\Button,
    Form\EmailInput,
    Form\Form,
    Form\Textarea,
    Form\TextInput,
    Div,
    TagBuilder
};

function ContactForm()
{
    /* row creation */
    $row = new Div("row justify-content-around");

    /* form title creation and insertion in row */

    $h1 = $row->addElement(TagBuilder::createNormalElement("h1"))->addText("Contactez-Nous");
    $h1->addClass("text-center");

    /* form creation and insertion inside row */

    $form = new Form("", "post");
    $form->addClass("col-lg-6");
    $row->addElement($form);

    /*## Form element creation ##*/

    /* prenom field */

    $prenomDiv = new Div("form-group");
    $prenom = $prenomDiv->addElement(new TextInput("prenom", "prenom", "Prénom", "fas fa-user text-primary"));
    $prenom->addClass("form-control");

    /* nom field */

    $nomDiv = new Div("form-group");
    $nom = $nomDiv->addElement(new TextInput("nom", "nom", "Nom", "fas fa-user text-success"));
    $nom->addClass("form-control");

    /* email field */

    $emailDiv = new Div("form-group");
    $email = $emailDiv->addElement(new EmailInput("email", "email", "Email", "fab fa-google text-danger"));
    $email->addClass("form-control");

    /* message field */

    $messageDiv = new Div("form-group");
    $message = $messageDiv->addElement(
        new Textarea("message", "message", "Votre Message", "fas fa-envelope text-info")
    );
    $message->addClass("form-control");

    /* btn element */

    $button = new Button("envoyer");
    $btnIcon = $button->addElement(TagBuilder::createNormalElement("i"));
    $btnIcon->addClass("fas fa-paper-plane");
    $button->addClass("btn btn-primary mt-3");


    /* Adding fields and button to form */

    $form->addElements([$prenomDiv, $nomDiv, $emailDiv, $messageDiv, $button]);

    /* Rendering the row */
    return $row->render();
}
