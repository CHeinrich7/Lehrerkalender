<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
//use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $inputAttr = array(
            'class-label'   => 'col-md-offset-2 col-md-3 col-sm-offset-1 col-sm-4',
            'class'         => 'col-md-3 col-sm-4'
        );

        $buttonAttr = array(
            'class'         => 'col-sm-9 col-md-8'
        );

        $builder
            ->add('username',   'text',     array('label' => 'Username', 'attr' => $inputAttr))
            ->add('password',   'password', array('label' => 'Passwort', 'attr' => $inputAttr))
            ->add('plainPassword', 'password', array('label' => 'neues Passwort', 'attr' => $inputAttr))
            ->add('save',       'submit',   array('label' => 'Einloggen', 'attr' => $buttonAttr))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user_usertype';
    }
} 