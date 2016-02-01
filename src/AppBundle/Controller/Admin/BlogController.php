<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Entity\BlogArticle;
use AppBundle\Service\BlogService;

/**
 * @Route("/admin/blog/list")
 */
class BlogController extends Controller
{
    /**
     * @var BlogService
     */
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
     * @Route("/", name="admin_blog_list")
     * @Method("get")
     */
    public function indexAction()
    {
        $blogs = $this->service->getAllPosts();

        return $this->render('Admin/index.html.twig', ['blogs' => $blogs]);
    }
}
