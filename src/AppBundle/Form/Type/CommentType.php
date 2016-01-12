<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Comment;

/**
 * @package AppBundle\Form\Type
 *
 * @DI\FormType()
 */
class CommentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', 'textarea')
            ->add('submit', 'submit', [
                'label' => 'コメント'
            ]);
    }
    public function getName()
    {
        return 'comment';
    }
}
