<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index()
    {
        $repository=$this->getDoctrine()->getRepository('App:Vehicule');
        $posts = $repository->findBy(
            ['location' => 'Disponible'],
        );

        return $this->render("site/index.html.twig",[
            'posts'=>$posts,
            'controller_name' => 'HomeController',
        ]);
    }


}
