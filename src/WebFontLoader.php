<?php declare(strict_types=1);

namespace ZdenekZahor\WebFontLoader;

use Nette\Application\UI\Control;
use Nette\Http\IRequest;
use Nette\Http\Url;

class WebFontLoader extends Control
{
    /** @var string */
    private $cookieName;

    /** @var array */
    private $families;

    /** @var IRequest */
    private $httpRequest;

    public function __construct(string $cookieName, array $families, IRequest $httpRequest)
    {
        $this->cookieName = $cookieName;
        $this->families = $families;
        $this->httpRequest = $httpRequest;
    }

    public function renderHtmlClass(): void
    {
        if ($this->httpRequest->getCookie($this->cookieName)) {
            echo 'wf-active';
        }
    }

    public function renderHead(): void
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/head.latte');

        $template->cookieName = $this->cookieName;

        $template->fontLink = new Url('//fonts.googleapis.com/css');
        $template->fontLink->setQueryParameter('family', implode('|', array_map(function ($family) {
            return $family['name'] . ':' . implode(',', $family['weights']);
        }, $this->families)));
        $template->fontLink->setQueryParameter('subset', implode(',', array_map(function ($family) {
            return implode(',', $family['subsets']);
        }, $this->families)));
        $template->fontLink = rawurldecode($template->fontLink->getAbsoluteUrl());

        if ($this->httpRequest->getCookie($this->cookieName)) {
            $template->isCached = true;
        } else {
            $template->isCached = false;
            $template->families = array_map(function ($family) {
                return $family['name'] . ':' . implode(',', $family['weights']) . ':' . implode(',', $family['subsets']);
            }, $this->families);
        }

        $template->render();
    }
}
