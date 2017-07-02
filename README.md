# WebFontLoader

```
composer require zdenekzahor/webfontloader
```

```yaml
extensions:
    webFontLoader: ZdenekZahor\WebFontLoader\DI\WebFontLoaderExtension

webFontLoader:
    cookieName: wfont
    families:
        -
            name: Play
            weights:
                - 400
                - 700
            subsets:
                - latin
                - latin-ext
```

```php
use ZdenekZahor\WebFontLoader\IWebFontLoaderFactory;

/**
 * @var IWebFontLoaderFactory
 * @inject
 */
public $webFontLoaderFactory;

protected function createComponentWebFontLoader()
{
    return $this->webFontLoaderFactory->create();
}
```

```latte
<!DOCTYPE html>
<html class="{control webFontLoader:htmlClass}">
<head>
    {control webFontLoader:head}
</head>
```

```css
html {
    font-family: sans-serif;
}

html.wf-active {
    font-family: 'Play', sans-serif;
}
```
