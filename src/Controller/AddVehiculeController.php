<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\CaractFormType;
use App\Form\VehiculeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddVehiculeController extends AbstractController
{
    /**
     * @Route("/ajoutVehicule", name="app_addVehicule")
     */
    public function index(Request $request)
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
            return $this->redirectToRoute('app_home');
        }

        return $this->render('site/add_vehicule.html.twig', [
            'formVehicule' => $form->createView(),
        ]);
    }
}
