<?php

namespace UserBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use UserBundle\Entity\Role;
use UserBundle\Entity\User;

//use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var User $user */
        $user = $builder->getData();

        $inputAttr = array(
            'class-label'   => 'col-md-offset-2 col-md-3 col-sm-offset-1 col-sm-4',
            'class'         => 'col-md-3 col-sm-4',
            'class-widget'  => 'no-chosen'
        );

        $buttonAttr = array(
            'class'         => 'col-sm-9 col-md-8'
        );

        $builder
            ->add('username',       'text',     array('label' => 'Username', 'attr' => $inputAttr))
            ->add('role',           'entity',   array(
                'label'     => 'Rolle',
                'attr'      => $inputAttr,
                'class'     => 'UserBundle\Entity\Role',
                'query_builder' => function(EntityRepository $repository) {
                    $qb = $repository->createQueryBuilder('r');

                    return $qb
                        ->where('r.role <> :role')
                        ->setParameter('role', Role::ROLE_SUPER_ADMIN);
                },
            ))
            ->add('password', 'password', array(
                'label' => ( $user->getId() > 0 )
                                ? 'altes Passwort'
                                : 'Passwort',
                'attr'  => $inputAttr
            ))
            ->add('plainPassword',  'password', array('label' => 'neues Passwort',  'attr' => $inputAttr))
            ->add('save',           'submit',   array('label' => 'Speichern',       'attr' => $buttonAttr))
        ;
    }

    public function setDefaultOptions( OptionsResolverInterface $resolver )
    {
        $resolver->setDefaults(array(
            'data_class'   => 'UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'usertype';
    }
} 