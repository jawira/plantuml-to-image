<?php declare(strict_types=1);

use Jawira\PlantUmlToImage\Format;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;
use function Jawira\TheLostFunctions\str_bytes;

class ProcessTest extends TestCase
{
  const MANTISSA = 100;

  /**
   * @dataProvider svgConversionProvider
   * @covers       \Jawira\PlantUmlToImage\PlantUml::convertTo
   * @covers       \Jawira\PlantUmlToImage\PlantUml::findJar
   * @covers       \Jawira\PlantUmlToImage\PlantUml::findPlantUml
   * @testdox      Svg from $filePath contains '$needle'.
   */
  function testSvgConversion($filePath, $needle, $size)
  {
    $diagram = file_get_contents($filePath);
    $process = new Jawira\PlantUmlToImage\PlantUml();
    $svg = $process->convertTo($diagram, Format::SVG);
    file_put_contents("$filePath.svg", $svg);

    $this->assertIsXml($svg);
    $this->assertGreaterThanOrEqual($size, str_bytes($svg));
    $this->assertStringContainsString($needle, $svg);
  }

  function svgConversionProvider(): array
  {
    return [
      ['resources/puml/colors.puml', 'BUSINESS', 40_000],
      ['resources/puml/colors2.puml', 'Darkorange', 6_500],
      ['resources/puml/help-types.puml', 'The possible types are', 3_690],
      ['resources/puml/help-themes.puml', 'crt-amber', 11_300],
      ['resources/puml/license.puml', 'PlantUML : a free UML diagram generator', 13_000],
      ['resources/puml/listopeniconic.puml', 'useiconic.com', 141_500],
      ['resources/puml/listsprite.puml', 'archimatetool.com', 49_000],
      ['resources/puml/skinparameters.puml', 'BoundaryStereotypeFontColor', 71_500],
      ['resources/puml/stdlib.puml', 'kubernetes', 12_400],
      ['resources/puml/version.puml', 'Installation seems OK.', 5_500],
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
