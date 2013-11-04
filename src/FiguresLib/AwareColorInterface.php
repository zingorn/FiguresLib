<?php
namespace FiguresLib;

interface AwareColorInterface 
{
    /**
     * @param Color $color
     * @return mixed
     */
    public function setColor(Color $color);

    /**
     * @return Color
     */
    public function getColor();
}