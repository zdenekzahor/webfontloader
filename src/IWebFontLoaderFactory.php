<?php declare(strict_types=1);

namespace ZdenekZahor\WebFontLoader;

interface IWebFontLoaderFactory
{
    /**
     * @return WebFontLoader
     */
    public function create(): WebFontLoader;
}
