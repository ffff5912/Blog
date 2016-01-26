<?php
namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Service\CategoryService;

/**
 * @Route("/admin/category/")
 */
class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private $service;

    /**
     * @DI\InjectParams({
     *   "service" = @DI\Inject("app.category_service")
     * })
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/", name="admin_category")
     * @Method("get")
     */
    public function indexAction()
    {
        $categories = $this->service->getAll();

        return $this->render('Admin/Category/index.html.twig', ['categories' => $categories]);
    }
}
