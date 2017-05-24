Victoire CMS Snake Bundle
============

Snake Bundle provide a basics ordered list widget

First you need to have a valid Symfony2 Victoire edition.
Then you just have to run the following composer command :

    php composer.phar require friendsofvictoire/snake-widget

Do not forget to add the bundle in your AppKernel !

```php
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                ...
                new Victoire\Widget\SnakeBundle\VictoireWidgetSnakeBundle(),
            );

            return $bundles;
        }
    }
```
