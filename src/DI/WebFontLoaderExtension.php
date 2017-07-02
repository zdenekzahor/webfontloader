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

        $service = new ServiceDefinition();
        $service->setImplement(IWebFontLoaderFactory::class);
        $service->setArguments([$this->config['cookieName'], $this->config['families']]);

        $builder->addDefinition($this->prefix('webFontLoaderFactory'), $service);
    }
}
