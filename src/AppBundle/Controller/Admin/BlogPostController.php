<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Entity\BlogArticle;
use AppBundle\Service\BlogPost;

/**
 * @Route("/admin/blog")
 */
class BlogPostController extends Controller
{
    /**
     * @var FormFactory
     */
    private $form_factory;

    /**
     * @var BlogPost
     */
    private $service;

    /**
     * @DI\InjectParams({
     *   "form_factory" = @DI\Inject("form.factory"),
     *   "service" = @DI\Inject("app.blog_post")
     * })
     */
    public function __construct(FormFactory $form_factory, BlogPost $service)
    {
        $this->form_factory = $form_factory;
        $this->service = $service;
    }

    /**
     * @Route("/")
     * @Method("get")
     */
    public function indexAction()
    {
        $form = $this->form_factory->create('blog_article');

        return $this->render('Admin/Blog/index.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/")
     * @Method("post")
     */
    public function indexPostAction(Request $request)
    {
        $form = $this->form_factory->create('blog_article');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->service->run($form->getData());

            return $this->redirect($this->generateUrl('app_admin_blogpost_complete'));
        }

        return $this->render('Admin/Blog/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/complete")
     */
    public function completeAction()
    {
        return $this->render('Admin/Blog/complete.html.twig');
    }
}
