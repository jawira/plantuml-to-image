# jawira/plantuml-process

**PlantUml wrapper to convert `.puml` diagrams to images.**

<!--
BADGES:
https://poser.pugx.org/
https://phppackages.org/p/jawira/case-converter
https://isitmaintained.com/
http://hits.dwyl.io/
https://shields.io/
-->

## Usage

It's up to you to load your diagram from disk, then use `PlantUmlProcess` to
convert the diagram to another format. After conversion, is up to you to save
new image to disk.

```php
use Jawira\PlantUmlProcess\Format;
use Jawira\PlantUmlProcess\PlantUmlProcess;

// Load diagram
$puml = file_get_contents('diagram.puml');

// Convert to png
$plantUmlProcess = new PlantUmlProcess($puml);
$png = $plantUmlProcess->convertTo(Format::PNG);

// Save diagram
file_put_contents('diagram.png', $png);
```

### Other methods

If you downloaded PlantUml as a jar file, you can specify its location:

```php
$plantUmlProcess->setJar('/path/to/plantuml.jar');
```

If you installed PlantUml in your system, then PlantUmlProcess should be able to
locate it automatically. Nevertheless, you can specify its location:

```php
$plantUmlProcess->setExecutable('/usr/bin/plantuml');
```

You can install PlantUml
with [jawira/plantuml](https://packagist.org/packages/jawira/plantuml), it
should work with `PlantUmlProcess` out of the box without further configuration.

## How to install

Install _PlantUmlProcess_ with:

```console
$ composer require jawira/plantuml-process
```

Optionally:

```console
$ composer require jawira/plantuml
```

## Requirements

This package needs [PlantUml](https://plantuml.com/en/download) (as an
executable or as a Jar file). PlantUml
has [its own requirements](https://plantuml.com/en/starting).

## Contributing

If you liked this project,
⭐ [star it on GitHub](https://github.com/jawira/plantuml-process).

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
