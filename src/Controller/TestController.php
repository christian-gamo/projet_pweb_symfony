<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="app_test")
     */
    public function index()
    {
        $posts=$this->getDoctrine()->getRepository('App:Vehicule')->findAll();
        dump($posts);
        return $this->render("site/test.html.twig",[
            'posts'=>$posts
        ]);
    }


}
