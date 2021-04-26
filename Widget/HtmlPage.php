<?php

namespace App\Widget;

use App\Widget\Models\NormalElement;
use App\Widget\Models\VoidElement;
use Gajus\Dindent\Exception\RuntimeException;
use Gajus\Dindent\Indenter;

/**
 * [Description HtmlPage]
 */
class HtmlPage
{
    private string $docType;
    private NormalElement $html;
    private VoidElement $metaCharset;
    private array $metaTags = [];
    private array $links = [];
    private array $scripts = [];
    private NormalElement $title;
    public NormalElement $pageBody;

    public function __construct()
    {
        $this->docType = "<!doctype html>";
        $this->html = TagBuilder::createNormalElement("html");
        $this->html->setAttribute("lang", "en");
        $head = $this->html->addElement(TagBuilder::createNormalElement("head"));
        $this->setCharset("utf-8");
        $head->addElement($this->metaCharset);
        $this->addMetaTag("viewport", "width=device-width, initial-scale=1, shrink-to-fit=no");
        $this->setTitle("Hello World");
        $head->addElement($this->title);
        $this->pageBody = $this->html->addElement(TagBuilder::createNormalElement("body"));
        $this->pageBody->addText("Hello World ", "first");
    }

    /**
     * addMetaTag
     *
     * @param string $name
     * @param string $content
     *
     * @return void
     */
    public function addMetaTag(string $name, $content = ""): void
    {
        $meta = TagBuilder::createVoidElement("meta");
        $meta->setAttributes(["name" => $name, "content" => $content]);
        $this->metaTags[] = $meta;
    }

    /**
     * getMetaTags
     *
     * @return array
     */
    public function getMetaTags(): array
    {
        return $this->metaTags;
    }


    /**
     * addLinks
     *
     * @param array $links
     *
     * @return void
     */
    public function addLinks(array $links): void
    {
        if (is_array($links)) {
            foreach ($links as $linkRel => $linkHref) {
                if (is_array($linkHref)) {
                    foreach ($linkHref as $href) {
                        $this->addLink($linkRel, $href);
                    }
                } else {
                    $this->addLink($linkRel, $linkHref);
                }
            }
        }
    }

    /**
     * addLink
     *
     * @param string $linkRel
     * @param string $linkHref
     *
     * @return void
     */
    public function addLink(string $linkRel, string $linkHref): void
    {
        $link = TagBuilder::createVoidElement("link");
        $link->setAttributes(["rel" => $linkRel, "href" => $linkHref]);
        $this->links[] = $link;
        unset($link);
    }

    /**
     * addScripts
     *
     * @param array $scripts
     *
     * @return void
     */
    public function addScripts(array $scripts): void
    {
        if (is_array($scripts)) {
            foreach ($scripts as $scriptType => $scriptSource) {
                if (is_array($scriptSource)) {
                    foreach ($scriptSource as $source) {
                        $script = TagBuilder::createNormalElement("script");
                        $script->setAttributes(["type" => $scriptType, "src" => $source]);
                        $this->scripts[] = $script;
                        unset($script);
                    }
                } else {
                    $script = TagBuilder::createNormalElement("script");
                    $script->setAttributes(["type" => $scriptType, "src" => $scriptSource]);
                    $this->scripts[] = $script;
                    unset($script);
                }
            }
        }
    }

    /**
     * addScript
     *
     * @param string $scriptType
     * @param string $scriptSource
     * @param string|null $loadMode
     *
     * @return void
     */
    public function addScript(string $scriptType, string $scriptSource, string $loadMode = null): void
    {
        $script = TagBuilder::createVoidElement("script");
        if (is_string($loadMode) && $loadMode !== "") {
            $script->setAttribute($loadMode, null);
        }
        $script->setAttributes(["type" => $scriptType, "src" => $scriptSource]);
        $this->scripts[] = $script;
        unset($script);
    }

    /**
     * setTitle
     *
     * @param string $title
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = TagBuilder::createNormalElement("title")->addText($title, "first");
    }

    /**
     * setCharset
     *
     * @param string $charset
     *
     * @return void
     */
    public function setCharset(string $charset = "utf-8"): void
    {
        $this->metaCharset = TagBuilder::createVoidElement("meta");
        $this->metaCharset->setAttribute("charset", $charset);
    }

    public function getBody(): NormalElement
    {
        $this->pageBody->removeText('first');
        return $this->pageBody;
    }

    public function renderPage(): string
    {
        foreach ($this->metaTags as $metaTag) {
            $this->title->insertBefore($metaTag);
        }
        foreach ($this->links as $link) {
            $this->title->insertBefore($link);
        }
        foreach ($this->scripts as $script) {
            $this->title->insertBefore($script);
        }
        return $this->docType . $this->html->render();
    }

    public function print(): void
    {
        echo $this->renderPage();
    }
}
