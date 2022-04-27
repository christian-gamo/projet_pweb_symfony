<?php

namespace App\Controller;

use \Datetime;
use \DateInterval;
use App\Entity\Vehicule;
use App\Entity\Facturation;
use App\Form\FacturationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FacturationController extends AbstractController
{
    /**
     * @Route("/ajoutFacturation", name="app_addFacturation")
     * @IsGranted("ROLE_CLIENT")
     */
    public function index(Request $request)
    {
        $facturation = new Facturation();

        $form = $this->createForm(FacturationFormType::class, $facturation, []);

        $facturation->setIdc($this->getUser());
        $facturation->setEtat(false);
        
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
            return $this->redirectToRoute('app_home');
        }

        return $this->render('client/add_facturation.html.twig', [
            'formFacturation' => $form->createView(),
        ]);
    }

    /**
     * @Route("/liste_des_vehicules_louees", name="app_liste_vehicules_location")
     * @IsGranted("ROLE_CLIENT")
     */
    public function listeVehiculesLocation()
    {
        $repository1=$this->getDoctrine()->getRepository('App:Facturation');
        $facturations = $repository1->findBy(
            ['idC' => $this->getUser()],
        );
        
        $vehicules=array();
        foreach($facturations as $f){
            array_push($vehicules,$f->getIdV());
        }
        

        return $this->render("client/liste_vehicules_location.html.twig",[
            'facturations'=>$facturations,
            'vehicules'=>$vehicules,
        ]);
    }


    /**
     * @Route("/liste_des_factures", name="app_liste_factures")
     * @IsGranted("ROLE_CLIENT")
     */
    public function listeFactures()
    {
        $repository1=$this->getDoctrine()->getRepository('App:Facturation');
        $facturations = $repository1->findBy(
            ['idC' => $this->getUser()],
        );
        
        return $this->render("client/liste_factures.html.twig",[
            'factures'=>$facturations,
        ]);
    }



    /**
     * @Route("/paiment/{id}", name="app_paiement")
     * @IsGranted("ROLE_CLIENT")
     */
    public function payer(Request $request,Vehicule $vehicule)
    {
        //$facturation=$vehicule->getFacturation()
    }




     /**
     * @Route("/liste_des_facturations", name="app_liste_facturations")
     * @IsGranted("ROLE_LOUEUR")
     */
    public function listeFacturations(Request $request)
    {
        $facturations=$this->getDoctrine()->getRepository('App:Facturation')->findAll();
        $dernierJourMois = new DateTime('last day of this month');
        $calculMoisCourant = array();

        return $this->render("loueur/liste_facturations.html.twig",[
            'facturations'=>$facturations,
            'calcul'=>$calculMoisCourant,
        ]);
    }
}
