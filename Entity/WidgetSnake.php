<?php

namespace Victoire\Widget\SnakeBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
        $this->scales = new ArrayCollection();
    }

    /**
     * @param Scale $scale
     * @return $this
     */
    public function addScales(Scale $scale)
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
     * @param ArrayCollection $scales
     * @return WidgetSnake
     */
    public function setScales($scales)
    {
        $this->scales = $scales;
        return $this;
    }
}