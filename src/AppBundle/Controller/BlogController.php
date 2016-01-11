<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Service\BlogService;
use AppBundle\Entity\BlogArticle;

class BlogController extends Controller
{
    private $service;
    /**
     * @DI\InjectParams({
     *   "service" = @DI\Inject("app.blog_service")
     * })
     */
    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $blogs = $this->service->getAllPosts();

        return $this->render('Blog/index.html.twig', [
            'blogs' => $blogs
        ]);
    }

    /**
     * @Route("/show/{id}")
     * @ParamConverter("blog", class="AppBundle:BlogArticle")
     * @Method("get")
     */
    public function showAction(BlogArticle $blog)
    {
        return $this->render('Blog/show.html.twig', [
            'blog' => $blog
        ]);

    }
}
