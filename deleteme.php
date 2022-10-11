<?php

use Jawira\PumlToImage\Format;
use Jawira\PumlToImage\PumlToImage;

require __DIR__ . '/vendor/autoload.php';

$puml = <<<PUML
@startuml
Bob -> Alice : hello
@enduml
PUML;


$converter = new PumlToImage();
$converter->setDiagram($puml);
$converter->setFormat(Format::XMI);
$process = $converter->getProcess();
$process->run();
echo $process->getOutput();
