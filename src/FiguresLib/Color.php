<?php
namespace FiguresLib;

class Color
{
    protected $r;

    protected $g;

    protected $b;

    /**
     * @param int $r
     * @param int $g
     * @param int $b
     * @return void
     */
    public function setRGB($r, $g, $b)
    {
        $this->r = (int) $r;
        $this->g = (int) $g;
        $this->b = (int) $b;
    }

    /**
     * @param string $hex
     * @return void
     */
    public function setHEX($hex)
    {
        if (preg_match('/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/', trim($hex), $index)){
            $this->r = hexdec($index[1]);
            $this->g = hexdec($index[2]);
            $this->b = hexdec($index[3]);
        }
    }

    /**
     * @param mixed $b
     */
    public function setB($b)
    {
        $this->b = $b;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getB()
    {
        return $this->b;
    }

    /**
     * @param mixed $g
     */
    public function setG($g)
    {
        $this->g = $g;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getG()
    {
        return $this->g;
    }

    /**
     * @param mixed $r
     */
    public function setR($r)
    {
        $this->r = $r;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getR()
    {
        return $this->r;
    }

    public function getRGB()
    {
        return (object)array(
            'r' => $this->r,
            'g' => $this->g,
            'b' => $this->b,
        );
    }
}