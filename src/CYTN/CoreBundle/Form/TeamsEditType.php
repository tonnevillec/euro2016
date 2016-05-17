<?php

namespace CYTN\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TeamsEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('shortName')
            ->add('flag',      new FlagType())
            ->add('save', 'submit')
        ;
    }

    public function getName()
    {
        return 'cytn_corebundle_teams_edit';
    }

    public function getParent()
    {
        return new TeamsType();
    }
}