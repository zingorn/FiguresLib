<?php
namespace FiguresLib\DrawingBoard;

use FiguresLib\AbstractDrawingBoard;
use FiguresLib\AwareColorInterface;
use FiguresLib\AwareLabelInterface;
use FiguresLib\Circle;
use FiguresLib\Rectangle;

class Gd extends AbstractDrawingBoard
{
    const VALIGN_TOP = 'valign_top';
    const VALIGN_MIDDLE = 'valign_middle';
    const VALIGN_BOTTOM = 'valign_bottom';
    const ALIGN_LEFT = 'align_left';
    const ALIGN_CENTER = 'align_center';
    const ALIGN_RIGHT = 'align_right';

    public function render()
    {
        $file = tempnam(sys_get_temp_dir(), 'fig');

        $im     = imagecreatetruecolor($this->getWidth(), $this->getHeight());
        imagesavealpha($im, true);

        $trans_colour = imagecolorallocatealpha($im, 0, 0, 0, 127);
        imagefill($im, 0, 0, $trans_colour);
        if ($this->getBackgroundColor()) {
            $rgb = $this->getBackgroundColor()->getRGB();
            $back = imagecolorallocate($im, $rgb->r, $rgb->g, $rgb->b);
        }

        $font = 5;
        $figures = $this->getFigures();
        if ($figures) {
            foreach ($figures as $fig) {
                $color = imagecolorallocate($im, rand(10, 100), rand(10, 100), rand(10, 100));
                $lineHeight = imagefontheight($font);

                $labelPosition = array();
                if ($fig instanceof AwareColorInterface) {
                    $c = $fig->getColor();
                    $color = imagecolorallocate($im, $c->getR(), $c->getG(), $c->getB());
                }
                if ($fig instanceof Circle) {
                    imagefilledellipse($im, $fig->getX(), $fig->getY(), $fig->getRadius(), $fig->getRadius(), $color);
                    $labelPosition = array(
                        $fig->getX() - $fig->getRadius(),
                        $fig->getY() - $fig->getRadius(),
                        $fig->getX() + $fig->getRadius(),
                        $fig->getY() + $fig->getRadius(),
                    );
                }

                if ($fig instanceof Rectangle) {
                    imagefilledrectangle($im, $fig->getX(), $fig->getY(), $fig->getX() + $fig->getWidth(), $fig->getY() + $fig->getHeight(), $color);
                    $labelPosition = array(
                        $fig->getX(),
                        $fig->getY(),
                        $fig->getX() + $fig->getWidth(),
                        $fig->getY() + $fig->getHeight(),
                    );
                }

                if ($fig instanceof AwareLabelInterface) {
                    $lColor = imagecolorsforindex($im, $color);
                    $lColor = imagecolorallocate($im, 255 - $lColor['red'], 255 - $lColor['green'], 255 - $lColor['blue']);
                    $this->imageStringBox($im, $fig->getLabel(), $lColor, $font, $labelPosition[0], $labelPosition[1],$labelPosition[2], $labelPosition[3]);
                }
            }
        }
        imagepng($im, $file);

        $data = file_get_contents($file);
        unlink($file);
        return 'data:image/PNG;base64,' . base64_encode($data);
    }

    protected function imageStringBox(&$image, $text, $color, $font, $left, $top, $right, $bottom, $align = self::ALIGN_CENTER, $valign = self::VALIGN_MIDDLE, $leading = 3)
    {
        // Get size of box
        $height = $bottom - $top;
        $width = $right - $left;

        // Break the text into lines, and into an array
        $lines = wordwrap($text, floor($width / imagefontwidth($font)), "\n", true);
        $lines = explode("\n", $lines);

        // Other important numbers
        $line_height = imagefontheight($font) + $leading;
        $line_count = floor($height / $line_height);
        $line_count = ($line_count > count($lines)) ? (count($lines)) : ($line_count);

        // Loop through lines
        for ($i = 0; $i < $line_count; $i++) {
            // Vertical Align
            switch($valign) {
                case self::VALIGN_TOP: // Top
                    $y = $top + ($i * $line_height);
                    break;
                case self::VALIGN_MIDDLE: // Middle
                    $y = $top + (($height - ($line_count * $line_height)) / 2) + ($i * $line_height);
                    break;
                case self::VALIGN_BOTTOM: // Bottom
                    $y = ($top + $height) - ($line_count * $line_height) + ($i * $line_height);
                    break;
                default:
                    return false;
            }

            // Horizontal Align
            $line_width = strlen($lines[$i]) * imagefontwidth($font);
            switch($align) {
                case self::ALIGN_LEFT: // Left
                    $x = $left;
                    break;
                case self::ALIGN_CENTER: // Center
                    $x = $left + (($width - $line_width) / 2);
                    break;
                case self::ALIGN_RIGHT: // Right
                    $x = $left + ($width - $line_width);
                    break;
                default:
                    return false;
            }

            // Draw
            imagestring($image, $font, $x, $y, $lines[$i], $color);
        }

        return true;
    }
}