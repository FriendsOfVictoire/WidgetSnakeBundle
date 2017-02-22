<?php

namespace Victoire\Widget\SnakeBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Bundle\CoreBundle\Form\EntityProxyFormType;
use Victoire\Bundle\CoreBundle\Form\WidgetType;
use Victoire\Bundle\FormBundle\Form\Type\LinkType;
use Victoire\Bundle\MediaBundle\Form\Type\MediaType;

/**
 * Class ScaleType
 * @package Victoire\Widget\SnakeBundle\Form
 */
class ScaleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $namespace = $options['namespace'];
        $businessEntityId = $options['businessEntityId'];

        if ($businessEntityId !== null) {
            if ($namespace === null) {
                throw new \Exception('The namespace is mandatory if the business_entity_id is given.');
            }
        }

        //choose form businessEntityId
        if ($businessEntityId === null) {
            //if no entity is given, we generate the static form that contains only title and description
            $builder
                ->add('title', TextType::class, [
                    'label' => 'widget_listing.form.listing_item.title.label'
                ])
                ->add('description', 'textarea', array(
                    'label' => 'widget_timeline_event.form.description.label',
                    'required' => false,
                ))
                ->add('image', MediaType::class, array(
                    'label' => 'widget_timeline_event.form.image.label',
                    'required' => false, ))
                ->add('link', LinkType::class)
                ->add('linkLabel', null, array(
                    'label' => 'form.widget_timeline_event.linkLabel.label',
                    'required' => false,
                ));

            //add the remove button
            self::addRemoveButton($builder);
        } else {

            //else, WidgetType class will embed a EntityProxyType for given entity
            $builder
                ->add('entity_proxy', EntityProxyFormType::class, [
                    'business_entity_id' => $businessEntityId,
                    'namespace'          => $namespace,
                    'widget'             => $options['widget'],
                    'mapped'             => false
                ]);

            //add the remove button
            self::addRemoveButton($builder);
        }

        $builder->add('position', HiddenType::class, [
                'data' => 0,
                'attr' => [
                    'data-type' => 'position',
                ],
            ]
        );
    }

    /**
     * @param FormBuilderInterface $builder
     */
    private function addRemoveButton(FormBuilderInterface $builder)
    {
        //add the remove button
        $builder->add('removeButton', ButtonType::class, [
            'label' => 'widget.form.WidgetListingItemType.removeButton.label',
            'attr'  => [
                'data-action' => 'remove-block',
                'class'       => 'vic-btn vic-btn-remove vic-btn-large vic-pull-right',
            ],
        ]);
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
            'data_class' => 'Victoire\Widget\SnakeBundle\Entity\Scale',
            'translation_domain' => 'victoire',
        ));

        $resolver->setDefined([
            'widget',
            'filters',
            'slot',
            'namespace',
            'businessEntityId',
            'mode',
        ]);
    }

    /**
     * get form name.
     *
     * @return string The form name
     */
    public function getBlockPrefix()
    {
        return 'victoire_widget_form_snake_scale';
    }
}