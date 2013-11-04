<?php
namespace FiguresLib;

abstract class AbstractFigure implements FigureInterface
{
    /** @var double */
    protected $x;

    /** @var  double */
    protected $y;

    /**
     * @return double
     */
    abstract public function calculateSquare();

    /**
     * @param float $x
     */
    public function setX($x)
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @return float
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param float $y
     */
    public function setY($y)
    {
        $this->y = $y;
        return $this;
    }

    /**
     * @return float
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param double $x
     * @param double $y
     * @return mixed
     */
    public function setPosition($x, $y)
    {
        $this->setX($x);
        $this->setY($y);
        return $this;
    }
}