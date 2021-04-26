<?php

use App\Widget\{
    Div, TagBuilder
};

function Footer(): string
{
    $footer = TagBuilder::createNormalElement("footer");
    $footer->addClass("gradient fixed-bottom");
    $footer_container = $footer->addElement(new Div("container-fluid text-center"));
    $footerAnchor = $footer_container->addElement(TagBuilder::createNormalElement("span"))
                                     ->addElement(TagBuilder::createNormalElement("a"));
    $footerAnchor->addText("&copy Mamadou Sarr 2020 - 2021");
    return $footer->render();
}
