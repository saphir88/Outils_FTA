<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('prenom', TextType::class, ['label' => 'Prénom* :'])
            ->add('nom', TextType::class, ['label' => 'Nom* :'])
            ->add('mail', EmailType::class, ['label' => 'Mail* :'])
            ->add('statut', ChoiceType::class, array('label'=>'Statut* :',
                'choices'  => array(
                    'Visiteur' => 'Visiteur',
                    'Investisseur' => 'Investisseur',
                ),'placeholder' => 'Choisissez votre statut'))
            ->add('societe', TextType::class, ['required' => false, 'label' => 'Société :']);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Participant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_participant';
    }


}
