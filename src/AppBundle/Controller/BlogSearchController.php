<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Service\BlogService;
use AppBundle\Entity\BlogArticle;

class BlogSearchController extends Controller
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
     * @Route("/article/{year}/{month}", requirements={"year": "\d{4}", "month": "\d{1,2}"})
     */
    public function dateAction($year, $month)
    {
        $blogs = $this->service->getPostByYearAndMonth($year, $month);

        return $this->render('Blog/index.html.twig', [
            'blogs' => $blogs
        ]);
    }
}
