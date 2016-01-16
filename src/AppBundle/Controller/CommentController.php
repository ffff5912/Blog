<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Service\CommentService;
use AppBundle\Entity\BlogArticle;
use AppBundle\Entity\Comment;

class CommentController extends Controller
{
    /**
     * @var FormFactory
     */
    private $form_factory;

    /**
     * @var CommentService
     */
    private $service;

    /**
     * @DI\InjectParams({
     *   "form_factory" = @DI\Inject("form.factory"),
     *   "service" = @DI\Inject("app.comment_service")
     * })
     */
    public function __construct(FormFactory $form_factory, CommentService $service)
    {
        $this->form_factory = $form_factory;
        $this->service = $service;
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
    public function createAction(Request $request, BlogArticle $blog)
    {
        $comment = new Comment($blog);
        $form = $this->form_factory->create('comment', $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->service->add($comment);

            return $this->redirect($this->generateUrl('app_blog_show', [
                'id' => $blog->getId()
            ]));
        }

        return $this->render('Comment/form.html.twig', [
            'form' => $form->createView(),
            'comment' => $comment
        ]);
    }
}
