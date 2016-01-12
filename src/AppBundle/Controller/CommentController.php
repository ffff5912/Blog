<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Service\BlogService;
use AppBundle\Entity\BlogArticle;
use AppBundle\Entity\Comment;

class CommentController extends Controller
{
    /**
     * @var FormFactory
     */
    private $form_factory;

    /**
     * @DI\InjectParams({
     *   "form_factory" = @DI\Inject("form.factory")
     * })
     */
    public function __construct(FormFactory $form_factory)
    {
        $this->form_factory = $form_factory;
    }

    /**
     * @Route("/comment/{id}")
     * @ParamConverter("blog", class="AppBundle:BlogArticle")
     * @Method("get")
     */
    public function indexAction(BlogArticle $blog)
    {
        $comment = new Comment($blog);
        $form = $this->form_factory->create('comment', $comment);

        return $this->render('Comment/form.html.twig', [
            'form' => $form->createView(),
            'comment' => $comment
        ]);
    }

    /**
     * @Route("comment/{id}")
     * @ParamConverter("blog", class="AppBundle:BlogArticle")
     * @Method("post")
     */
    public function createAction(BlogArticle $blog)
    {
    }
}
