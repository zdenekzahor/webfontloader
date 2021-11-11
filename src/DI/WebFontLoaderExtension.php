<?php declare(strict_types=1);

namespace ZdenekZahor\WebFontLoader\DI;

use Nette\DI\CompilerExtension;
use Nette\DI\ServiceDefinition;
use ZdenekZahor\WebFontLoader\IWebFontLoaderFactory;

class WebFontLoaderExtension extends CompilerExtension
{
    public function loadConfiguration(): void
    {
        $builder = $this->getContainerBuilder();
        $builder
            ->addFactoryDefinition($this->prefix('webFontLoaderFactory'))
            ->setImplement(IWebFontLoaderFactory::class)
            ->getResultDefinition()->setArguments([$this->config['cookieName'], $this->config['families']]);
    }
}
