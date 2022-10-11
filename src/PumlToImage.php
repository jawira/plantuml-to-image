<?php declare(strict_types=1);

use Symfony\Component\Process\Process;

class PumlToImage
{
  /** Jar file provided by `jawira/plantuml`. */
  public const JAR_PATH = 'vendor/jawira/plantuml/bin/plantuml.jar';
  /** PlantUml options. */
  protected const OPTIONS = ['-pipe', '-failfast2', '-Djava.awt.headless=true', '-Xmx1024m', '-charset', 'UTF-8'];
  /**
   * PlantUml diagram to be converted.
   * @var string|null
   */
  protected ?string $puml = null;
  /**
   * Jar file provided by user.
   * @var string|null
   */
  protected ?string $jar = null;
  /**
   * Executable provided by user.
   * @var string|null
   */
  protected ?string $executable = null;

  /**
   * Set diagram (the content of .puml file).
   *
   * @param string $puml
   * @return $this
   */
  public function setDiagram(string $puml): self
  {
    $this->puml = $puml;

    return $this;
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
   * Create `Process` object, it's up to you to execute and get the image.
   *
   * @return \Symfony\Component\Process\Process
   */
  public function createProcess(?string $cwd = null): Process
  {
    $plantUml = $this->findPlantUml();
    $command = [...$plantUml, ...self::OPTIONS];

    $process = new Process($command);
    $process->setInput($this->puml);

    return $process;
  }

  /**
   * Returns PlantUml Jar or Executable, if not found `plantuml` is returned by default.
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

    // Jar provided by jawira/plantuml
    if ($jarInVendor = $this->findJarInVendor()) {
      return ['java', '-jar', $jarInVendor];
    }

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
}
