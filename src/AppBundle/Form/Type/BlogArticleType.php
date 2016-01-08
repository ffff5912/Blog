<?php
namespace AppBundle\Form\Type;

use AppBundle\Entity\BlogArticle;
use Symfony\Component\Form\AbstractType;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @package AppBundle\Form\Type
 *
 * @DI\FormType()
 */
class BlogArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BlogArticle::class
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('content', 'textarea')
            ->add('submit', 'submit', [
                'label' => '投稿'
            ]);
    }
    public function getName()
    {
        return 'blog_article';
    }
}
