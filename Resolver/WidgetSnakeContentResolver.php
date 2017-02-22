<?php

namespace Victoire\Widget\SnakeBundle\Resolver;

use Victoire\Bundle\WidgetBundle\Model\Widget;
use Victoire\Bundle\WidgetBundle\Resolver\BaseWidgetContentResolver;

/**
 * Class WidgetSnakeContentResolver
 * @package Victoire\Widget\SnakeBundle\Resolver
 */
class WidgetSnakeContentResolver extends BaseWidgetContentResolver
{
    /**
     * @param Widget $widget
     * @return string
     */
    public function getWidgetStaticContent(Widget $widget)
    {
        $parameters = parent::getWidgetStaticContent($widget);
        return $parameters;
    }
}