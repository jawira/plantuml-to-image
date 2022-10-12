<?php declare(strict_types=1);

namespace Jawira\PlantUmlProcess;

use Symfony\Component\Process\Process;

class PlantUmlProcess
{
  /**
   * Default `jar` provided by `jawira/plantuml`.
   */
  public const JAR_PATH = 'vendor/jawira/plantuml/bin/plantuml.jar';

  /**
   * Options to be used with plantuml process.
   */
  protected const OPTIONS = ['-pipe', '-failfast2', '-Djava.awt.headless=true', '-Xmx1024m', '-charset', 'UTF-8'];

  /**
   * PlantUml diagram.
   */
  protected string $puml;

  /**
   * Path to `plantuml.jar`.
   * @var string|null
   */
  protected ?string $jar = null;

  /**
   * Path to `plantuml` executable.
   * @var string|null
   */
  protected ?string $executable = null;

  /**
   * @param string $puml This is the diagram to be converted, you must provide the diagram itself and not a file path. If you want to convert a file, it's up to you to load that file into a variable.
   */
  public function __construct(string $puml)
  {
    $this->puml = $puml;
  }

  public function setJar(string $jar): self
  {
    $this->jar = $jar;

    return $this;
  }

  public function setExecutable(string $executable): self
  {
    $this->executable = $executable;

    return $this;
  }

  /**
   * Convert diagram  into requested format.
   * @param string $format Must be a valid PlantUml format: `png`, `svg`, `eps`, `txt`, ...
   */
  public function convertTo(string $format): string
  {
    $plantUml = $this->findPlantUml();
    $command = array_merge($plantUml, self::OPTIONS, ["-t$format"]);

    $process = new Process($command);
    $process->setInput($this->puml);
    $process->mustRun();

    return $process->getOutput();
  }

  /**
   * Returns PlantUml Jar or Executable, if not found `plantuml` is returned by default.
   * @return string[]
   */
  protected function findPlantUml(): array
  {
    // Jar provided by user
    if (is_string($this->jar)) {
      return ['java', '-jar', $this->jar];
    }

    // Executable provided by user
    if (is_string($this->executable)) {
      return [$this->executable];
    }

    // Find jar provided by jawira/plantuml
    if ($jarInVendor = $this->findJarInVendor()) {
      return ['java', '-jar', $jarInVendor];
    }

    // Find executable in system
    return $this->findExecutable();
  }

  /**
   * Tries to find jar file installed in `vendor` with `jawira/plantuml`.
   *
   * @see https://github.com/jawira/plantuml
   */
  protected function findJarInVendor(): ?string
  {
    for ($i = 1; $i <= 10; $i++) {
      $dirname = dirname(__FILE__, $i);
      $filename = $dirname . DIRECTORY_SEPARATOR . self::JAR_PATH;
      if (is_file($filename)) {
        return $filename;
      }
    }

    return null;
  }

  /**
   * @return string[]
   */
  protected function findExecutable(): array
  {
    // PlantUml executable
    if (is_file($plantUml = '/usr/local/bin/plantuml')) {
      return [$plantUml];
    }

    // PlantUml executable
    if (is_file($plantUml = '/usr/bin/plantuml')) {
      return [$plantUml];
    }

    // Assuming PlantUml is installed somewhere else
    return ['plantuml'];
  }
}
