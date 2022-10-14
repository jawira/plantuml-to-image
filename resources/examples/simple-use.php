<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Jawira\PlantUmlToImage\Format;
use Jawira\PlantUmlToImage\PlantUml;

// Load diagram
$puml = file_get_contents('./diagram.puml');

// Convert to png
$plantUml = new PlantUml();
$png = $plantUml->convertTo($puml, Format::PNG);

// Save diagram
file_put_contents('./diagram.png', $png);
