<?php declare(strict_types=1);

use Jawira\PlantUmlToImage\Format;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;
use function Jawira\TheLostFunctions\str_bytes;

class ProcessTest extends TestCase
{
  /**
   * @dataProvider svgConversionProvider
   * @covers       \Jawira\PlantUmlToImage\PlantUml::convertTo
   * @covers       \Jawira\PlantUmlToImage\PlantUml::findJar
   * @covers       \Jawira\PlantUmlToImage\PlantUml::findPlantUml
   * @testdox      Svg from $filePath contains '$needle'.
   */
  function testSvgConversion($filePath, $needle, $bytes)
  {
    $diagram = file_get_contents($filePath);
    $process = new Jawira\PlantUmlToImage\PlantUml();
    $svg = $process->convertTo($diagram, Format::SVG);
    $delta = abs($bytes - str_bytes($svg));

    $this->assertIsXml($svg);
    $this->assertLessThanOrEqual(10, $delta);
    $this->assertStringContainsString($needle, $svg);
  }

  function svgConversionProvider()
  {
    return [
      ['resources/puml/colors.puml', 'BUSINESS', 40620],
      ['resources/puml/colors2.puml', 'Darkorange', 6830],
      ['resources/puml/help.puml', 'There are some other help command:', 3690],
      ['resources/puml/help-themes.puml', 'crt-amber', 11840],
      ['resources/puml/license.puml', 'PlantUML : a free UML diagram generator', 17090],
      ['resources/puml/listopeniconic.puml', 'useiconic.com', 141770],
      ['resources/puml/listsprite.puml', 'archimatetool.com', 52775],
      ['resources/puml/skinparameters.puml', 'BoundaryStereotypeFontColor', 71740],
      ['resources/puml/stdlib.puml', 'kubernetes', 14296],
      ['resources/puml/version.puml', 'Installation seems OK.', 5920],
    ];
  }

  function assertIsXml(string $xml, $message = '')
  {
    libxml_use_internal_errors(true);
    $simpleXml = simplexml_load_string($xml);

    static::assertThat(
      $simpleXml,
      new LogicalNot(new IsType(IsType::TYPE_BOOL)),
      $message ?: 'Fail that input string is valid XML'
    );
  }
}
