<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'attr' => array(
                    'placeholder' => '',
                    'pattern'     => '.{2,}' //minlength
                ),'label'=>'Escriu el teu nom'
            ))
            ->add('email', 'email', array(
                'attr' => array(
                    'placeholder' => ''
                ),'label'=>'Adreça de correu'
            ))
            ->add('subject', 'text', array(
                'attr' => array(
                    'placeholder' => '',
                    'pattern'     => '.{3,}' //minlength
                ),'label'=>'Assumpte del correu'
            ))
            ->add('message', 'textarea', array(
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => ''
                ),'label'=>'Què em vols explicar ?'
            ))
            ->add('save', 'submit', array('label'=>'Enviar'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $collectionConstraint = new Collection(array(
            'name' => array(
                new NotBlank(array('message' => 'El nom no pot estar buit')),
                new Length(array('min' => 2))
            ),
            'email' => array(
                new NotBlank(array('message' => 'Email should not be blank.')),
                new Email(array('message' => 'Escrigui una adressa de correo vàlida'))
            ),
            'subject' => array(
                new NotBlank(array('message' => 'El camp assumpte no pot estar buit')),
                new Length(array('min' => 3))
            ),
            'message' => array(
                new NotBlank(array('message' => 'El missatge no pot estar buit')),
                new Length(array('min' => 5))
            )
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
        ));
    }

    public function getName()
    {
        return 'contact';
    }
}