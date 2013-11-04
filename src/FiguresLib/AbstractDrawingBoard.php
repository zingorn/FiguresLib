<?php
namespace FiguresLib;

abstract class AbstractDrawingBoard
{
    /** @var  array */
    protected $figures;

    /** @var   */
    protected $image;

    /** @var  int */
    protected $width = 400;

    /** @var int */
    protected $height = 200;

    /** @var  Color */
    protected $backgroundColor;

    /**
     * @param FigureInterface $
     * @return void
     */
    public function addFigure(FigureInterface $figure)
    {
        $this->figures[] = $figure;
    }

    /**
     * @return string
     */
    abstract public function render();

    /**
     * @param Color $backgroundColor
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * @return Color
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param array $figures
     */
    public function setFigures($figures)
    {
        $this->figures = $figures;
        return $this;
    }

    /**
     * @return array
     */
    public function getFigures()
    {
        return $this->figures;
    }
}