<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class, array('attr' => array('maxlength' => 100), 'label'=>"Intitulé de l'évenement* :"))
            ->add('file', FileType::class, ['data_class' => null, 'required' => false, 'label'=>"Flyer de l'évenement* :"])
            ->add('description', CKEditorType::class, ['config' => array(
                'config_name' => 'my_config',
                ),
                'label'=>"Description de l'évenement* :", 'attr' => ['maxlength' => 1000]])
            ->add('date', DateTimeType::class, ['label' => 'Date* :', 'date_widget' => 'single_text', 'time_widget' => 'single_text'])
            ->add('localisation',TextType::class, array('attr' => array('maxlength' => 100), 'label'=> 'Localisation :'))
            ->add('nbMaxParticipants', ChoiceType::class, ['label' => 'Nombre de participants* :','choices' => range(0,2000)]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_event';
    }


}
