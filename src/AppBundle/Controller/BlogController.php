<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Service\BlogService;

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
        $posts = $this->service->getAllPosts();

        return $this->render('Blog/index.html.twig', [
            'posts' => $posts
        ]);
    }
}
