<?php

namespace Victoire\Widget\SnakeBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use PhpParser\Node\Expr\Cast\String_;
use Victoire\Bundle\WidgetBundle\Entity\Widget;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class WidgetSnake
 * @package Victoire\Widget\SnakeBundle\Entity
 *
 * @ORM\Table("vic_widget_snake")
 * @ORM\Entity
 */
class WidgetSnake extends Widget
{
    const SNAKE_SCALE_TYPE_ICONNED = "iconned";
    const SNAKE_SCALE_TYPE_SIMPLE = "simple";

    /**
     * @var String
     * @ORM\Column(name="scale_type", type="string", length=255)
     */
    private $scaleType = self::SNAKE_TYPE_SIMPLE;

    /**
     * @var String
     * @ORM\Column(name="spine_color", type="string", length=255)
     */
    private $spineColor;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Scale", mappedBy="snake", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $scales;

    /**
     * WidgetSnake constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->scales = new ArrayCollection();
    }

    /**
     * @param Scale $scale
     * @return $this
     */
    public function addScale(Scale $scale)
    {
        $scale->setSnake($this);
        $this->scales->add($scale);
        return $this;
    }

    /**
     * @param Scale $scale
     * @return $this
     */
    public function removeScale(Scale $scale)
    {
        $this->scales->remove($scale);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getScales()
    {
        return $this->scales;
    }

    /**
     * @return String
     */
    public function getScaleType()
    {
        return $this->scaleType;
    }

    /**
     * @param String $scaleType
     * @return WidgetSnake
     */
    public function setScaleType($scaleType)
    {
        $this->scaleType = $scaleType;
        return $this;
    }

    /**
     * @return String
     */
    public function getSpineColor()
    {
        return $this->spineColor;
    }

    /**
     * @param String $spineColor
     * @return WidgetSnake
     */
    public function setSpineColor($spineColor)
    {
        $this->spineColor = $spineColor;
        return $this;
    }
}