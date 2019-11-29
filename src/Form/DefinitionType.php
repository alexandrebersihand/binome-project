<?php

namespace App\Form;

use App\Entity\Definition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DefinitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'label' => $options['Nom'],
            ))
            ->add('language', TextType::class, array(
                'label' => $options['Language'],
            ))
            ->add('content', TextareaType::class, array(
                'label' => $options['Content'],
                'attr' => array(
                    'placeholder' => 'Inserer votre définition'
                )))
            ->add('author', TextType::class, array(
                'label' => $options['author'],
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'Nom' => 'Nom de la balise:' ,
            'Language' => 'Type de langage :',
            'Content' => 'Définition :',
            'author' => 'Auteur:',
            'data_class' => Definition::class,
        ]);
    }
}
