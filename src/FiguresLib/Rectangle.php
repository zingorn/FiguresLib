<?php
namespace FiguresLib;

class Rectangle extends AbstractFigure
{
    /** @var  int */
    protected $height;

    /** @var  int */
    protected $width;

    /**
     * @return double
     */
    public function calculateSquare()
    {
        return $this->getX() * $this->getY();
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
}