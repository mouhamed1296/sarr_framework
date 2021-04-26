<?php

use App\Widget\Form\{
    Button,
    CheckboxInput,
    DateInput,
    EmailInput,
    FileInput,
    Form,
    NumberInput,
    Option,
    PasswordInput,
    RadioInput,
    Select,
    TelInput,
    Textarea,
    TextInput,
    WeekInput,
};
use App\Widget\Bootstrap\{
    BootstrapCard,
    BootstrapButton,
    BootstrapCarousel
};
use App\Widget\{
    TagBuilder,
    Heading,
    Div
};

/**
 * @return string
 */
function Form(): string
{

    $heading = new Heading('Form examples');
    $carousel = new BootstrapCarousel([
        'img/19.jpg class:d-block w-100',
        'img/5.jpg class:d-block w-100',
        'img/11.jpg class:d-block w-100',
        'img/16.jpg class:d-block w-100',
        'img/17.jpg class:d-block w-100',
        'img/19.jpg class:d-block w-100'
    ]);
    $carousel->addClass('col-lg-6');
    $carousel->images = array_map(static fn($image) => $image->setAttribute('style', 'height: 500px;'), $carousel->images);
    $cardRow = new Div('row justify-content-between');
    $cardBtn = new BootstrapButton('submit', 'button', 'add to cart', 'primary', 'default', 'fas fa-cart-plus');
    $card = new BootstrapCard(
        null,
        ['img/5.jpg' => 'top'],
        'My Card st:Card SubTitle',
        'Ceci est un robinet de qualité supérieure',
        $cardBtn->render()
    );
    $card->addClass('col-2 mx-1 my-2');
    $i = 0;
    while ($i < 10) {
        $cardRow->addElement($card);
        $i++;
    }
    $form = new Form();
    $form->addElement(new TextInput('firstname', 'firstname', 'First name'));
    $form->addElement(new TextInput('email', 'email', 'Email'));
    $form->addElement(new PasswordInput('password', 'password', 'Password'));
    //$selectLabel = TagBuilder::createNormalElement("label");
    //$selectLabel->addText("Ville");
    $select = new Select("ville", "ville", "Choisissez votre ville");
    //$selectLabel->setAttribute("for", $select->getAttribute("id"));
    /*$select->addElement(new Option("dakar"));
    $select->addElement(new Option("pikine"));
    $select->addElement(new Option("louga"));*/
    $select->addElements([
        new Option('dakar'),
        new Option('pikine'),
        new Option('louga')
    ]);
    //$form->addElement(new Label("Ville", $select->getAttribute("id")));
    $form->addElement($select);
    $form->addElement(new DateInput("date", "date", "Date Naissance"));
    $form->addElement(new FileInput("file", "file", "Votre Fichier"));
    $files = new FileInput('files[]', "files", "Files");
    $files->setAttribute("multiple", "");
    $form->addElement($files);
    $form->addElement(new NumberInput("number", "number", "Nombre"));
    $form->addElement(new EmailInput("email", "email", "Email"));
    $form->addElement(new TelInput("tel", "tel", "Telephone"));
    $form->addElement(new CheckboxInput("orange", "orange", "Orange"));
    $form->addElement(new RadioInput("choix", "choix", "Choix"));
    $form->addElement(TagBuilder::createVoidElement("input"))
        ->setAttributes([
            "type" => "file",
            "name" => "files[]",
            "multiple" => null
        ]);
    $form->addElement(
        new Textarea(
            '',
            'textarea',
            'I am a textarea',
            'My awesome textarea'
        )
    );
    $form->addElement(new WeekInput('week', 'week', 'Choose a week'));
    $form->addClass('d-flex flex-column col-lg-6');
    $form->addElement(new Button("Submit", "submit"));
    echo $heading->render();
    echo $carousel->render();
    echo $cardRow->render();
    return $form->render();
}
