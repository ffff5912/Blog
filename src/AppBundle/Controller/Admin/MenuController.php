<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MenuController extends Controller
{
    /**
     * @Route("/admin/")
     */
    public function indexAction()
    {
        return $this->render('Admin/Common/index.html.twig');
    }
}
