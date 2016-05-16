<?php

namespace CYTN\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GroupsEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('save', 'submit')
        ;
    }

    public function getName()
    {
        return 'cytn_corebundle_groups_edit';
    }

    public function getParent()
    {
        return new GroupsType();
    }
}