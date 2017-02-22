<?php

namespace Victoire\Widget\SnakeBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Bundle\CoreBundle\Form\WidgetType;

class WidgetSnakeType extends WidgetType
{
    /**
     * define form fields.
     *
     * @param FormBuilderInterface $builder
     *
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $businessEntityId = $options['businessEntityId'];
        $namespace = $options['namespace'];
        $mode = $options['mode'];

        $builder->add('events', CollectionType::class, array(
            'type' => new ScaleType($businessEntityId, $namespace, $options['widget']),
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'options' => array(
                'namespace' => $namespace,
                'businessEntityId' => $businessEntityId,
                'mode' => 'static',
            ),
            'attr' => array('id' => 'static'),
        ));

        //add the mode to the form
        $builder->add('mode', HiddenType::class, array(
            'data' => $mode,
        ));

        //add the slot to the form
        $builder->add('slot', HiddenType::class, array());
        parent::buildForm($builder, $options);
        $builder->remove('items');
    }

    /**
     * bind form to WidgetTimeline entity.
     *
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'data_class' => 'Victoire\Widget\SnakeBundle\Entity\WidgetSnake',
            'widget' => 'Snake',
            'translation_domain' => 'victoire',
        ));
    }

    /**
     * get form name.
     *
     * @return string The form name
     */
    public function getBlockPrefix()
    {
        return 'victoire_widget_form_snake';
    }
}