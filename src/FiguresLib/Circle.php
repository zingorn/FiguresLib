<?php
namespace FiguresLib;

class Circle extends AbstractFigure
{
    /** @var  double */
    protected $radius;

    public function __construct($radius = null)
    {
        if ($radius) {
            $this->setRadius($radius);
        }
    }

    /**
     * @param float $radius
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
        return $this;
    }

    /**
     * @return float
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @return double
     */
    public function calculateSquare()
    {
        return M_PI * pow($this->getRadius(), 2);
    }
}