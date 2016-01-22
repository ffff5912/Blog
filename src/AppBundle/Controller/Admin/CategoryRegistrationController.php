<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\DiExtraBundle\Annotation as DI;
use AppBundle\Entity\Category;
use AppBundle\Service\CategoryService;

/**
 * @Route("/admin/category/registration")
 */
class CategoryRegistrationController extends Controller
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
     * @Route("/", name="category_registration")
     * @Method("get")
     */
    public function indexAction()
    {
        $form = $this->form_factory->create('category');

        return $this->render('Admin/Category/Registration/index.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/", name="category_registration_save")
     * @Method("post")
     */
    public function saveAction(Request $request)
    {
        $form = $this->form_factory->create('category');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->service->add($form->getData());

            return $this->redirect($this->generateUrl('app_admin_category_complete'));
        }

        return $this->render('Admin/Category/Registration/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/complete", name="app_admin_category_complete")
     * @Method("get")
     */
    public function completeAction()
    {
        return $this->render('Admin/Category/Registration/complete.html.twig');
    }
}
