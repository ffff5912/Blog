<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Entity\BlogArticle;

/**
 * @Route("/admin/blog")
 */
class AdminBlogPostController extends Controller
{
    /**
     * @DI\InjectParams({
     *   "form_factory" = @DI\Inject("form.factory")
     * })
     */
    public function __construct($form_factory)
    {
        $this->form_factory = $form_factory;
    }

    /**
     * @Route("/")
     * @Method("get")
     */
    public function indexAction()
    {
        $form = $this->get('form.factory')->create('blog_article');

        return $this->render('Admin/Blog/index.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/")
     * @Method("post")
     */
    public function indexPostAction(Request $request)
    {
        $form = $this-get('form.factory')->create('blog_article');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $blog = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();
        }

        return $this->render('Admin/Blog/index.html.twig', [
            'form' => $form->crateView()
        ]);
    }

    /**
     * @return Form
     */
    private function createBlogForm()
    {
        return $this->createFormBuilder(new BlogArticle())
            ->add('title', 'text')
            ->add('content', 'textarea')
            ->add('submit', 'submit', [
                'label' => '投稿'
            ])
            ->getForm();
    }
}
