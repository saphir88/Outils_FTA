<?php

namespace AppBundle\Form;

use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommunauteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomStartup', TextType::class, array('label'=>'Nom de la startup* :'))
            ->add('logo', FileType::class, array('label' => 'Logo :', 'data_class' => null))
            ->add('description', TextareaType::class, array('required'=> false, 'label'=>'Description :'))
            ->add('siteWeb', TextType::class, array('required'=> true, 'label'=>'Site Web* :'))
            ->add('video', TextType::class, array('required' => false , 'label' => 'Lien Youtube :'))
            ->add('facebook', TextType::class, array('required' => false , 'label' => 'Lien Facebook :'))
            ->add('twitter', TextType::class, array('required' => false , 'label' => 'Lien Twitter :'))
            ->add('linkedin', TextType::class, array('required' => false , 'label' => 'Lien Linkedin :'))
            ->add('categorie', ChoiceType::class, array('label'=>'Domaine* :',
                'choices'  => array(
                    'HealthTech' => 'HealthTech',
                    'service informatique BtoB' => 'service informatique BtoB',
                    'Ed Tech Entertainment' => 'Ed Tech Entertainment',
                    'IOT Manufacturing' => 'IOT Manufacturing',
                    'CleanTech/Mobility' => 'CleanTech/Mobility',
                    'FoodTech' => 'FoodTech',
                    'Sports' => 'Sports',
                    'Retail' => 'Retail',
                    'Fintech' => 'Fintech',
                    'Security Privacy' => 'Security Privacy',
                    'Service Informatique BtoC' => 'service informatique BtoC'
                ),'placeholder' => 'Choisissez votre domaine'))
            ->add('siret', TextType::class, array('required'=> false,'label'=>'SIRET :'))
            ->add('adresse', TextType::class, array('label'=>'Adresse* :'))
            ->add('nomContact', TextType::class, array('label'=>'Nom du contact* :'))
            ->add('mail', EmailType::class, array('label'=>'Email du contact* :'))
            ->add('validation', TextType::class)
            ->add('telephone', TelType::class, array('label' => 'N° de téléphone du contact* :'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Communaute',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_communaute';
    }


}
