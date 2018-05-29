<?php

namespace AppBundle\Form;

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

class CommunautesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomStartup', TextType::class, array('label'=>'Nom de la startup* :'))
            ->add('logo', FileType::class, array('label' => 'Logo :'))
            ->add('description', TextareaType::class, array('required'=> false, 'label'=>'Description :'))
            //->add('video', TextType::class, array('required'=> false, 'label'=>'Vidéo :'))
            ->add('siteWeb', TextType::class, array('required'=> false, 'label'=>'Site Web :'))
            ->add('categorie', ChoiceType::class, array('label'=>'Domaine* :',
                'choices'  => array(

                    'HealthTech' => 'HealthTech',
                    'Service Informatique BtoB' => 'Service Informatique BtoB',
                    'Ed Tech Entertainement' => 'Ed Tech Entertainement',
                    'IOT Manufacturing' => 'IOT Manufacturing',
                    'CleanTech/Mobility' => 'CleanTech/Mobility',
                    'FoodTech' => 'FoodTech',
                    'Sports' => 'Sports',
                    'Retail' => 'Retail',
                    'Fintech' => 'Fintech',
                    'Security Privacy' => 'Security Privacy',
                    'Service Informatique BtoC' => 'Service Informatique BtoC'
                ),))
            ->add('siret', TextType::class, array('required'=> false,'label'=>'SIRET :'))
            ->add('adresse', TextType::class, array('label'=>'Adresse* :'))
            ->add('nomContact', TextType::class, array('label'=>'Nom du contact* :'))
            ->add('mail', EmailType::class, array('label'=>'Email du contact* :'))
            ->add('telephone', TelType::class, array('label' => 'N° de téléphone du contact* :'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Communautes'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_communautes';
    }


}
