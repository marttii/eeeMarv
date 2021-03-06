<?php

namespace Eeemarv\EeemarvBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

// use Eeemarv\EeemarvBundle\Form\EventListener\ParentCategorySubscriber;



class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('parent', 'entity', array(
				'class' => 'EeemarvBundle:Category',
				'query_builder' => function(EntityRepository $er) {
					return $er->createQueryBuilder('c')
					//	->where('c.level <> 0')
						->orderBy('c.root, c.left', 'ASC');
				},
				'property' => 'identedName',
            ));
//            ->add('parent', 'eeemarv_parent_category_type');
//		->addEventSubscriber(new ParentCategorySubscriber());

    }

    /** 
	* ability to disable choice in form'  https://github.com/symfony/symfony/pull/7510
	*/

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Eeemarv\EeemarvBundle\Entity\Category'
        ));
    }

    public function getName()
    {
        return 'eeemarv_category_type';
    }
}
