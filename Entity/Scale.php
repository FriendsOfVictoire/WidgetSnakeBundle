<?php

namespace Victoire\Widget\SnakeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Bundle\MediaBundle\Entity\Media;
use Victoire\Bundle\CoreBundle\Annotations as VIC;

/**
 * Class Scale
 * @package Victoire\Widget\SnakeBundle\Entity
 *
 * @ORM\Table("vic_widget_snake_scale")
 * @ORM\Entity
 */
class Scale
{
    use \Victoire\Bundle\WidgetBundle\Entity\Traits\LinkTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @VIC\ReceiverProperty("textable")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @VIC\ReceiverProperty("textable")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="\Victoire\Bundle\MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="CASCADE")
     * @VIC\ReceiverProperty("imageable")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="WidgetSnake", inversedBy="scales")
     * @ORM\JoinColumn(name="snake_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $snake;

    /**
     * @var string
     *
     * @ORM\Column(name="link_label", type="string", length=55, nullable=true)
     */
    private $linkLabel;

    /**
     * @ORM\Column(name="position", type="integer")
     */
    protected $position = 0;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Scale
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Scale
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Scale
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getSnake()
    {
        return $this->snake;
    }

    /**
     * @param string $snake
     * @return Scale
     */
    public function setSnake($snake)
    {
        $this->snake = $snake;
        return $this;
    }

    /**
     * @return string
     */
    public function getLinkLabel()
    {
        return $this->linkLabel;
    }

    /**
     * @param string $linkLabel
     * @return Scale
     */
    public function setLinkLabel($linkLabel)
    {
        $this->linkLabel = $linkLabel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     * @return Scale
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }
}