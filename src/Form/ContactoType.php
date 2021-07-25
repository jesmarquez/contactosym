<?php

namespace App\Form;

use App\Entity\Contacto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;

class ContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, [
                'constraints' => [new NotBlank(), new Regex( ['pattern' => '/^[a-zA-Z\s\.]*$/',])]
            ])
            ->add('apellido', TextType::class, [
                'constraints' => [new NotBlank(), new Regex( ['pattern' => '/^[a-zA-Z\s\.]*$/',])]
            ])
            ->add('correo', TextType::class, [
                'constraints' => [new NotBlank(), new Email()]
            ])
            ->add('celular', TextType::class, [
                'constraints' => new NotBlank(),
            ])
            ->add('area', TextType::class, [
                'constraints' => new NotBlank(),
            ])
            ->add('mensaje', TextType::class, [
                'constraints' => new NotBlank(),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contacto::class,
        ]);
    }
}
