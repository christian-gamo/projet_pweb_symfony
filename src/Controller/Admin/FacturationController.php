<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FacturationRepository;
use App\Form\FacturationFormType;
use Gedmo\Sluggable\Util\Urlizer;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Facturation;
/**
 * @Route("/admin/facturation", name="admin_facturation_")
 * @package App\Controller\Admin
 */
class FacturationController extends AbstractController
{
    /**
     * @Route("/", name="home_facturation")
     */
    public function index(FacturationRepository $facRepo)
    {
        return $this->render('admin/facturation/index.html.twig', [
            'facturation' => $facRepo->findAll()
        ]);
    }
     /**
     * @Route("/ajoutFacturation", name="app_admin_addFacturation")
     */
    public function ajout(Request $request)
    {
        $facturation = new Facturation();

        $form = $this->createForm(FacturationFormType::class, $facturation, []);
    
        $form->handleRequest($request );
    
        if ($form->isSubmitted() && $form->isValid()) {
             $debut =$facturation->getDateD();
           
            $fin = $facturation->getDateF();
             $intervalle = $debut->diff($fin);
             $jours = $intervalle->days;
          
            $facturation->setValeur($facturation->getIdV()->getPrixJour() * $jours);
            $facturation->getIdV()->setLocation("En location");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($facturation);
            $entityManager->flush();
            $this->addFlash('success', 'Facturation ajouté !');
            return $this->redirectToRoute('admin_facturation_home_facturation');
        }

        return $this->render('admin/facturation/add_facturation.html.twig', [
            'formFacturation' => $form->createView(),
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function ModifFacturation(Facturation $facturation, Request $request)
    {

        $form = $this->createForm(VehiculeFormType::class, $facturation, []);
    
        $form->handleRequest($request );
    
        if ($form->isSubmitted() && $form->isValid()) {
            $debut =$facturation->getDateD();
            $fin = $facturation->getDateF();
            $intervalle = $debut->diff($fin);
            $jours = $intervalle->days;
          
            $facturation->setValeur($facturation->getIdV()->getPrixJour() * $jours);
            $facturation->getIdV()->setLocation("En location");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($facturation);
            $entityManager->flush();
            $this->addFlash('success', 'Facturation ajouté !');
            return $this->redirectToRoute('admin_facturation_home_facturation');
        }

        return $this->render('admin/facturation/add_facturation.html.twig', [
            'formFacturation' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer")
     */
    public function supprimer(Facturation $facturation)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($facturation);
        $em->flush();

        $this->addFlash('message', 'Facture supprimée avec succès');
        return $this->redirectToRoute('admin_facturation_home_facturation');
    }
    
}

    
