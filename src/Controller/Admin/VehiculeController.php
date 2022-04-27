<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VehiculeRepository;
use App\Form\VehiculeFormType;
use Gedmo\Sluggable\Util\Urlizer;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Vehicule;
/**
 * @Route("/admin/vehicule", name="admin_vehicule_")
 * @package App\Controller\Admin
 */
class VehiculeController extends AbstractController
{
    /**
     * @Route("/", name="home_vehicule")
     */
    public function index(VehiculeRepository $vehRepo)
    {
        return $this->render('admin/vehicule/index.html.twig', [
            'vehicule' => $vehRepo->findAll()
        ]);
    }
     /**
     * @Route("/ajoutVehicule", name="app_admin_addVehicule")
     */
    public function ajout(Request $request)
    {
        $vehicule = new Vehicule();

        $form = $this->createForm(VehiculeFormType::class, $vehicule, []);
    
        $form->handleRequest($request );
    
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile=$form['imageFile']->getData();
            $destination = $this->getParameter('kernel.project_dir').'/public/uploads/vehicule_image';
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
            $uploadedFile->move(
                $destination,
                $newFilename
            );

           $vehicule->setImage($newFilename);
           
           
           
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vehicule);
            $entityManager->flush();
            $this->addFlash('success', 'Véhicule ajouté !');
            return $this->redirectToRoute('/admin/vehicule');
        }

        return $this->render('/site/add_vehicule.html.twig', [
            'formVehicule' => $form->createView(),
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function ModifVehicule(Vehicule $vehicule, Request $request)
    {

        $form = $this->createForm(VehiculeFormType::class, $vehicule, []);
    
        $form->handleRequest($request );
    
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile=$form['imageFile']->getData();
            $destination = $this->getParameter('kernel.project_dir').'/public/uploads/vehicule_image';
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
            $uploadedFile->move(
                $destination,
                $newFilename
            );

           $vehicule->setImage($newFilename);
           
           
           
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vehicule);
            $entityManager->flush();
            $this->addFlash('success', 'Véhicule modifié !');
            return $this->redirectToRoute('admin_vehicule_home');
        }

        return $this->render('loueur/add_vehicule.html.twig', [
            'formVehicule' => $form->createView(),
        ]);
    }

    
}
