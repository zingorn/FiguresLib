<?php
namespace FiguresLib;

interface AwareLabelInterface
{
    /**
     * @param string $label
     * @return mixed
     */
    public function setLabel($label);

    /**
     * @return string
     */
    public function getLabel();
}