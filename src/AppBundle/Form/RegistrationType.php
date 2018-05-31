<?php
/**
 * Created by PhpStorm.
 * User: m0rsak
 * Date: 30/05/18
 * Time: 15:40
 */


namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\User;
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
use Symfony\Component\HttpFoundation\Request;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomStartup', TextType::class, array('label'=>'Nom de la startup* :'))
            ->add('logo', FileType::class, array('label' => 'Logo :', 'data_class' => null))
            ->add('description', TextareaType::class, array('required'=> false, 'label'=>'Description :'))
            ->add('siteWeb', TextType::class, array('required'=> false, 'label'=>'Site Web :'))
            ->add('video', TextType::class, array('required' => false , 'label' => 'Lien Youtube :'))
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
            ->add('validation', HiddenType::class, array('data' => '0'))
            ->add('telephone', TelType::class, array('label' => 'N° de téléphone du contact* :'));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }


    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}