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

        $tmpScale = null;
        $reversedRow = false;

        foreach ($parameters['scales'] as $key => $scale) {
            if ($key % 2 == 0 && $reversedRow == true) {
                $tmpScale = $scale;
            } elseif ($key % 2 == 1 && $reversedRow == true) {
                $parameters['scales'][$key-1] = $scale;
                $parameters['scales'][$key] = $tmpScale;
                $reversedRow = false;
                $tmpScale = null;
            } elseif ($key % 2 == 1 && $reversedRow == false && $key != 0) {
                $parameters['scales'][$key] = $scale;
                $reversedRow = true;
            } else {
                $parameters['scales'][$key] = $scale;
            }
        }

        return $parameters;
    }
}