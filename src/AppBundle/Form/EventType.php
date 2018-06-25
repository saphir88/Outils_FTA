<?php

namespace AppBundle\Form;

use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use Symfony\Component\Form\AbstractType;
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
            ->add('titre')
            ->add('image', null, ['required' => false])
            ->add("description", FroalaEditorType::class, array(
                "language" => "fr",
                "toolbarInline" => true,
                "tableColors" => ["#FFFFFF", "#FF0000"],
                "saveInterval" => "0",
                "imageUpload" => false,
                "toolbarButtons" => ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough',
                    'subscript', 'superscript', '|', 'fontFamily', 'fontSize', 'color', 'inlineStyle',
                    'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent',
                    'indent', 'quote', '-', 'insertLink', 'insertTable', '|', 'emoticons', 'specialCharacters',
                    'insertHR', 'clearFormatting', '|', 'html', '|', 'undo', 'redo']
            ))
            ->add('date')
            ->add('localisation')
            ->add('nbMaxParticipants');
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
