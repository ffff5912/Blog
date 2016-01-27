<?php
namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Service\CategoryService;
use AppBundle\Entity\Category;

/**
 * @Route("/admin/category/edit")
 */
class CategoryEditController extends Controller
{
    /**
     * @var FormFactory
     */
    private $form_factory;
    /**
     * @var CategoryService
     */
    private $service;

    /**
     * @DI\InjectParams({
     *   "form_factory" = @DI\Inject("form.factory"),
     *   "service" = @DI\Inject("app.category_service")
     * })
     */
    public function __construct(FormFactory $form_factory, CategoryService $service)
    {
        $this->form_factory = $form_factory;
        $this->service = $service;
    }

    /**
     * @Route("/{id}", name="category_edit")
     * @ParamConverter("category", class="AppBundle:Category")
     * @Method("get")
     */
    public function editAction(Category $category)
    {
        $form = $this->form_factory->create('category', $category);

        return $this->render('Admin/Category/Registration/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="category_edit_post")
     * @ParamConverter("category", class="AppBundle:Category")
     * @Method("post")
     */
    public function editPostAction(Request $request, Category $category)
    {
        $form = $this->form_factory->create('category', $category);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->service->update();

            return $this->redirect($this->generateUrl('admin_category'));
        }

        return $this->render('Admin/Category/Registration/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
