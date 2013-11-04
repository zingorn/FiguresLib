<?php
namespace FiguresLib;

interface FigureInterface
{
    /**
     * @param   double $x
     * @return mixed
     */
    public function setX($x);

    /**
     * @param double $y
     * @return mixed
     */
    public function setY($y);

    /**
     * @param double $x
     * @param double $y
     * @return mixed
     */
    public function setPosition($x, $y);
}