<?php
namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Service\CategoryService;
use AppBundle\Entity\Category;

/**
 * @Route("/admin/category/remove")
 */
class CategoryRemoveController extends Controller
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
     * @Route("/{id}", name="category_remove")
     * @ParamConverter("category", class="AppBundle:Category")
     * @Method("get")
     */
    public function removeAction(Category $category)
    {
        $this->service->remove($category);

        return $this->render('Admin/Category/index.html.twig');
    }
}
