<?php declare(strict_types=1);

namespace Jawira\PlantUmlToImage;

class Format
{
  /** To generate images using PNG format (default) */
  public const PNG = 'png';
  /** To generate images using SVG format */
  public const SVG = 'svg';
  /** To generate images using EPS format */
  public const EPS = 'eps';
  /** To generate images using PDF format */
  public const PDF = 'pdf';
  /** To generate images using VDX format */
  public const VDX = 'vdx';
  /** To generate XMI file for class diagram */
  public const XMI = 'xmi';
  /** To generate SCXML file for state diagram */
  public const SCXML = 'scxml';
  /** To generate HTML file for class diagram */
  public const HTML = 'html';
  /** To generate images with ASCII art */
  public const TXT = 'txt';
  /** To generate images with ASCII art using Unicode characters */
  public const UTXT = 'utxt';
  /** To generate images using LaTeX/Tikz format */
  public const LATEX = 'latex';
  /** To generate images using LaTeX/Tikz format without preamble */
  public const LATEX_NOPREAMBLE = 'latex:nopreamble';
}
