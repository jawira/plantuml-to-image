<?php declare(strict_types=1);

namespace Jawira\PumlToImage;

class Format
{
  /** -tpng    To generate images using PNG format (default) */
  public const PNG = '-tpng';
  /** -tsvg    To generate images using SVG format */
  public const SVG = '-tsvg';
  /** -teps    To generate images using EPS format */
  public const EPS = '-teps';
  /** -tpdf    To generate images using PDF format */
  public const PDF = '-tpdf';
  /** -tvdx    To generate images using VDX format */
  public const VDX = '-tvdx';
  /** -txmi    To generate XMI file for class diagram */
  public const XMI = '-txmi';
  /** -tscxml    To generate SCXML file for state diagram */
  public const SCXML = '-tscxml';
  /** -thtml    To generate HTML file for class diagram */
  public const HTML = '-thtml';
  /** -ttxt    To generate images with ASCII art */
  public const TXT = '-ttxt';
  /** -tutxt    To generate images with ASCII art using Unicode characters */
  public const UTXT = '-tutxt';
  /** -tlatex    To generate images using LaTeX/Tikz format */
  public const LATEX = '-tlatex';
  /** -tlatex:nopreamble To generate images using LaTeX/Tikz format without preamble */
  public const LATEX_NOPREAMBLE = '-tlatex:nopreamble';
}
