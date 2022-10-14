# PlantUml to image

**PlantUml wrapper to convert `.puml` diagrams into images.**

<!--
BADGES:
https://poser.pugx.org/
https://phppackages.org/p/jawira/case-converter
https://isitmaintained.com/
http://hits.dwyl.io/
https://shields.io/
-->

## Usage

It's up to you to load your diagram from disk, then
use `\Jawira\PlantUmlToImage\PlantUml` to convert the diagram to another format.
After conversion, it's up to you to save new image to disk.

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

## How to install

```console
$ composer require jawira/plantuml-to-image
```

## Requirements

This package needs _PlantUml_ (<https://plantuml.com/en/download>) (as an
executable or as a Jar file), note that _PlantUml_
has [its own requirements](https://plantuml.com/en/starting).

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
