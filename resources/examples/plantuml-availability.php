<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Jawira\PlantUmlToImage\PlantUml;

// Convert to png
$plantUml = new PlantUml();
if ($plantUml->isPlantUmlAvailable()) {
  echo 'Found PlantUml in your system.', PHP_EOL;
} else {
  echo 'Sorry, cannot convert diagram.', PHP_EOL;
}
