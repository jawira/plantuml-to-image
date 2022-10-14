<?php declare(strict_types=1);

namespace Jawira\PlantUmlToImage;

use Symfony\Component\Process\Process;

class PlantUml
{
  protected const JAVA_OPTIONS = ['java', '-Djava.net.useSystemProxies=true', '-Djava.awt.headless=true', '-Xmx1024m', '-jar'];
  protected const PLANTUML_OPTIONS = ['-pipe', '-failfast2', '-charset', 'UTF-8'];
  protected const PLANTUML_LIMIT_SIZE = '20000';

  /**
   * Path to `plantuml.jar`.
   *
   * @var string|null
   */
  protected ?string $jar = null;

  /**
   * Set Jar file location.
   */
  public function setJar(string $path): self
  {
    $this->jar = $path;

    return $this;
  }

  /**
   * Convert diagram  into requested format.
   *
   * @param string $diagram This is the diagram to be converted, you must provide the diagram itself and not a file
   *                        path. Otherwise, it's up to you to load that file into a variable.
   * @param string $format  Must be a valid PlantUml format: `png`, `svg`, `eps`, `txt`, ...
   * @throws \Jawira\PlantUmlToImage\PlantUmlException
   */
  public function convertTo(string $diagram, string $format): string
  {
    $plantUml = $this->findPlantUml();
    $command = array_merge($plantUml, self::PLANTUML_OPTIONS, ["-t$format"]);
    $PLANTUML_LIMIT_SIZE = getenv('PLANTUML_LIMIT_SIZE') ?: self::PLANTUML_LIMIT_SIZE;

    $process = new Process($command, null, compact('PLANTUML_LIMIT_SIZE'));
    $process->setInput($diagram);
    $process->mustRun();

    return $process->getOutput();
  }

  /**
   * Returns PlantUml Jar or Executable, if not found `plantuml` is returned by default.
   *
   * @return string[]
   * @throws \Jawira\PlantUmlToImage\PlantUmlException
   */
  protected function findPlantUml(): array
  {
    // Jar
    $candidate = $this->findJar();
    if (is_array($candidate)) {
      return $candidate;
    }

    // Executable
    $candidate = $this->findExecutable();
    if (is_array($candidate)) {
      return $candidate;
    }

    throw new PlantUmlException('Cannot found PlantUml, try installing `plantuml/jawira`.');
  }

  /**
   * Tries to find jar file installed in `vendor` with `jawira/plantuml`.
   *
   * Jar provided by used has priority and is returned immediately without verification.
   * Null is returned if jar is not found.
   *
   * @see https://github.com/jawira/plantuml
   * @return null|string[]
   */
  protected function findJar(): ?array
  {
    $command = self::JAVA_OPTIONS;

    // Jar provided by user
    if (is_string($this->jar)) {
      $command[] = $this->jar;

      return $command;
    }

    // Jar provided by `jawira/plantuml`
    for ($i = 1; $i <= 10; $i++) {
      $candidate = dirname(__FILE__, $i) . DIRECTORY_SEPARATOR . 'vendor/jawira/plantuml/bin/plantuml.jar';
      if (is_file($candidate)) {
        $command[] = $candidate;

        return $command;
      }
    }

    // Jar when installed using apt-get
    $candidate = '/usr/share/plantuml/plantuml.jar';
    if (is_file($candidate)) {
      $command[] = $candidate;

      return $command;
    }

    return null;
  }

  /**
   * Returns PlantUml executable if available.
   *
   * Executable provided by used has priority and is returned immediately without verification.
   * Null is returned if executable is not found.
   *
   * @return null|string[]
   */
  protected function findExecutable(): ?array
  {
    // PlantUml executable
    $candidate = '/usr/local/bin/plantuml';
    if (is_file($candidate)) {
      return [$candidate];
    }

    // PlantUml executable
    $candidate = '/usr/bin/plantuml';
    if (is_file($candidate)) {
      return [$candidate];
    }

    if ($this->isPlantUmlInPath()) {
      return ['plantuml'];
    }

    return null;
  }

  /**
   * Checks `plantuml` is located as path variable.
   */
  protected function isPlantUmlInPath(): bool
  {
    $process = Process::fromShellCommandline('plantuml -help');
    $process->run();

    return 0 === $process->getExitCode();
  }
}
