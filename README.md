# PlantUml to image

**PlantUml wrapper to convert `.puml` diagrams into images.**

[![Latest Stable Version](http://poser.pugx.org/jawira/plantuml-to-image/v)](https://packagist.org/packages/jawira/plantuml-to-image)
[![Total Downloads](http://poser.pugx.org/jawira/plantuml-to-image/downloads)](https://packagist.org/packages/jawira/plantuml-to-image)
[![PHP Version Require](http://poser.pugx.org/jawira/plantuml-to-image/require/php)](https://packagist.org/packages/jawira/plantuml-to-image)
[![License](http://poser.pugx.org/jawira/plantuml-to-image/license)](https://packagist.org/packages/jawira/plantuml-to-image)

## Usage

This package provides three methods:

1. `\Jawira\PlantUmlToImage\PlantUml::convertTo`
2. `\Jawira\PlantUmlToImage\PlantUml::setJar`
3. `\Jawira\PlantUmlToImage\PlantUml::isPlantUmlAvailable`

### Convert .puml diagram to image

It's up to you to load your diagram from disk, then
use `\Jawira\PlantUmlToImage\PlantUml` to convert the diagram to another format,
after conversion, it's up to you to save new image to disk:

```php
use Jawira\PlantUmlToImage\Format;
use Jawira\PlantUmlToImage\PlantUml;

// Load diagram
$puml = file_get_contents('./diagram.puml');

// Convert to png
$plantUml = new PlantUml();
$png = $plantUml->convertTo($puml, Format::PNG);

// Save diagram
file_put_contents('./diagram.png', $png);
```

### Set Jar location

Specify the location of `plantuml.jar`:

```php
$plantUml->setJar('/path/to/plantuml.jar');
```

You don't need to set Jar location in the following cases:

1. You have downloaded PlantUML
   with [jawira/plantuml](https://github.com/jawira/plantuml)
   , (location `vendor/jawira/plantuml/bin/plantuml.jar`).
2. If you have installed PlantUML with apt-get
   (location `/usr/share/plantuml/plantuml.jar`).
3. Or if you have `plantuml` command installed.

### Check PlantUml availability

An exception is thrown when jar can't be found, use this method to avoid the
exception.

```php
if ($plantUml->isPlantUmlAvailable()) {
  echo 'PlantUml is available.', PHP_EOL;
} else {
  echo 'Sorry, cannot convert diagram.', PHP_EOL;
}
```

## How to install

```console
$ composer require jawira/plantuml-to-image
```

## Requirements

This package needs _PlantUml_ (<https://plantuml.com/en/download>) as an
executable or as a Jar file, note that _PlantUml_
has its own requirements (<https://plantuml.com/en/starting>).

As an alternative, you can install _PlantUml_ with Composer:

```console
$ composer require jawira/plantuml
```

## Contributing

If you liked this project,
⭐ [star it on GitHub](https://github.com/jawira/plantuml-to-image).

## License

This library is licensed under the [MIT license](LICENSE.md).


***

## Packages from jawira

<dl>

<dt>
    <a href="https://packagist.org/packages/jawira/doctrine-diagram-bundle">jawira/doctrine-diagram-bundle
    <img alt="GitHub stars" src="https://badgen.net/github/stars/jawira/doctrine-diagram-bundle?icon=github"/></a>
</dt>
<dd>Symfony Bundle to generate database diagrams.</dd>

<dt>
    <a href="https://packagist.org/packages/jawira/case-converter">jawira/case-converter
    <img alt="GitHub stars" src="https://badgen.net/github/stars/jawira/case-converter?icon=github"/></a>
</dt>
<dd>Convert strings between 13 naming conventions: Snake case, Camel case,
  Pascal case, Kebab case, Ada case, Train case, Cobol case, Macro case,
  Upper case, Lower case, Sentence case, Title case and Dot notation.
</dd>

<dt><a href="https://packagist.org/packages/jawira/">more...</a></dt>
</dl>
