<?php

namespace AppBundle\Form;

use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
        $builder
            ->add('nomStartup', TextType::class, array('label'=>'Nom de la startup* :'))
            ->add('nomSociete', TextType::class, array('required'=> false, 'label'=>'Nom de la societe :'))
            ->add('file', FileType::class, ['label' => 'Logo* :', 'data_class' => null])
            ->add('description', TextareaType::class, array('required'=> false, 'label'=>'Description :'))
            ->add('siteWeb', TextType::class, array('required'=> true, 'label'=>'Site Web* :'))
            ->add('video', TextType::class, array('required' => false , 'label' => 'Lien Youtube :'))
            ->add('ChaineYouTube', TextType::class, array('required' => false , 'label' => 'Chaine YouTube :'))
            ->add('facebook', TextType::class, array('required' => false , 'label' => 'Lien Facebook :'))
            ->add('twitter', TextType::class, array('required' => false , 'label' => 'Lien Twitter :'))
            ->add('linkedin', TextType::class, array('required' => false , 'label' => 'Lien Linkedin :'))
            ->add('categorie', ChoiceType::class, array('label'=>'Domaine* :',
                'choices'  => array(
                    'HealthTech' => 'HealthTech',
                    'IoT Manufacturing' => 'IoT Manufacturing',
                    'Ed Tech Entertainment' => 'Ed Tech Entertainment',
                    'AI'=>'AI',
                    'IOT Manufacturing' => 'IOT Manufacturing',
                    'VR/VA'=>'VR/VA',
                    'Blockchain'=>'Blockchain',
                    'FoodTech' => 'FoodTech',
                    'Mobility' => 'Mobility',
                    'IT/ Software / App'=>'IT/ Software / App',
                    'Smartcity'=>'Smartcity',
                    'Sustainability'=>'Sustainability',




                ),'placeholder' => 'Choisissez votre domaine'))
            ->add('siret', TextType::class, array('required'=> false,'label'=>'SIRET :'))
            ->add('adresse', TextType::class, array('label'=>'Adresse* :'))
            ->add('nomContact', TextType::class, array('label'=>'Nom du contact* :'))
            ->add('mail', EmailType::class, array('label'=>'Email du contact* :'))
            ->add('telephone', TelType::class, array('label' => 'N° de téléphone du contact* :'))
            ->add('validation', HiddenType::class, ['required' => false])
            ->add('images', CollectionType::class, [
                'entry_type' => ImagesType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false

            ]);



    }
    /**
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
