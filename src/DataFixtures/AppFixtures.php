<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Vehicule;
use App\Entity\Facturation;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $admin= new Utilisateur();
        $admin->setEmail("sense@gmail.com");
        $password=$this->encoder->encodePassword($admin,'sense1234');
        $admin->setPassword($password);
        $admin->setRoles(["ROLE_ADMIN"]);
        $admin->setIsLoueur(true);
        $admin->setNom("Xavier Sense");
        $manager->persist($admin);

        //Loueur
        $loueur= new Utilisateur();
        $loueur->setEmail("ilie@gmail.com");
        $password=$this->encoder->encodePassword($loueur,'ilie1234');
        $loueur->setPassword($password);
        $loueur->setIsLoueur(true);
        $loueur->setRoles(["ROLE_LOUEUR"]);
        $loueur->setNom("Jean-Michel Ilié");
        $manager->persist($loueur);

        //Clients
        $client1= new Utilisateur();
        $client1->setEmail("mouhamadou@gmail.com");
        $password=$this->encoder->encodePassword($client1,'mouhamadou1234');
        $client1->setPassword($password);
        $client1->setIsLoueur(false);
        $client1->setRoles(["ROLE_CLIENT"]);
        $client1->setNom("Mouhamadou Soumare");
        $manager->persist($client1);

        $client2= new Utilisateur();
        $client2->setEmail("christian@gmail.com");
        $password=$this->encoder->encodePassword($client2,'christian1234');
        $client2->setPassword($password);
        $client2->setIsLoueur(false);
        $client2->setRoles(["ROLE_CLIENT"]);
        $client2->setNom("Christian Gamo");
        $manager->persist($client2);

        $client3= new Utilisateur();
        $client3->setEmail("polnareff@gmail.com");
        $password=$this->encoder->encodePassword($client3,'polnareff1234');
        $client3->setPassword($password);
        $client3->setIsLoueur(false);
        $client3->setRoles(["ROLE_CLIENT"]);
        $client3->setNom("Jean-Pierre Polnareff");
        $manager->persist($client3);


        //Véhicules
        $vehicule1= new Vehicule();
        $vehicule1->setType("Ford Taurus");
        $caract=['Moteur' => 'GPL','Vitesse' => 'Automatique','NombreDePlaces' => 5];
        $vehicule1->setCaract($caract);
        $vehicule1->setLocation("Disponible");
        $vehicule1->setImage("ford_taurus.png");
        $vehicule1->setPrixJour(60);
        $manager->persist($vehicule1);

        $vehicule2= new Vehicule();
        $vehicule2->setType("Alfa Romeo Stelvio");
        $vehicule2->setCaract(['Moteur' => 'Diesel', 'Vitesse' => 'Manuelle', 'NombreDePlaces' => 5]);
        $vehicule2->setLocation("Disponible");
        $vehicule2->setImage("alfa_romeo_stelvio.png");
        $vehicule2->setPrixJour(80);
        $manager->persist($vehicule2);

        $vehicule3= new Vehicule();
        $vehicule3->setType("Honda Civic 5D");
        $vehicule3->setCaract(['Moteur' => 'Hybride', 'Vitesse' => 'Automatique', 'NombreDePlaces' => 2]);
        $vehicule3->setLocation("Disponible");
        $vehicule3->setImage("honda_civic_5d.png");
        $vehicule3->setPrixJour(110);
        $manager->persist($vehicule3);

        $vehicule4= new Vehicule();
        $vehicule4->setType("Jeep Renegade");
        $vehicule4->setCaract(['Moteur' => 'E85', 'Vitesse' => 'Séquentielle', 'NombreDePlaces' => 5]);
        $vehicule4->setLocation("En révision");
        $vehicule4->setImage("jeep_renegade.png");
        $vehicule4->setPrixJour(63);
        $manager->persist($vehicule4);

        $vehicule5= new Vehicule();
        $vehicule5->setType("Mazda CX-30");
        $vehicule5->setCaract(['Moteur' => 'Essence', 'Vitesse' => 'Séquentielle', 'NombreDePlaces' => 4]);
        $vehicule5->setLocation("En révision");
        $vehicule5->setImage("mazda_cx-30.png");
        $vehicule5->setPrixJour(100);
        $manager->persist($vehicule5);

        $vehicule6= new Vehicule();
        $vehicule6->setType("Nissan Sentra SV");
        $vehicule6->setCaract(['Moteur' => 'Électrique', 'Vitesse' => 'Automatique', 'NombreDePlaces' => 4]);
        $vehicule6->setLocation("En révision");
        $vehicule6->setImage("nissan_sentra_sv.png");
        $vehicule6->setPrixJour(90);
        $manager->persist($vehicule6);

        $vehicule7= new Vehicule();
        $vehicule7->setType("Toyota GR Supra");
        $vehicule7->setCaract(['Moteur' => 'Essence', 'Vitesse' => 'Automatique', 'NombreDePlaces' => 2]);
        $vehicule7->setLocation("Disponible");
        $vehicule7->setImage("toyota_gr_supra.png");
        $vehicule7->setPrixJour(95);
        $manager->persist($vehicule7);
        
        $vehicule8= new Vehicule();
        $vehicule8->setType("Ford EcoSport S");
        $vehicule8->setCaract(['Moteur' => 'Essence', 'Vitesse' => 'Automatique', 'NombreDePlaces' => 5]);
        $vehicule8->setLocation("Disponible");
        $vehicule8->setImage("ford_ecosport_s.png");
        $vehicule8->setPrixJour(75);
        $manager->persist($vehicule8);
        
        $vehicule9= new Vehicule();
        $vehicule9->setType("Ford Ranger XL");
        $vehicule9->setCaract(['Moteur' => 'Hybride', 'Vitesse' => 'Automatique', 'NombreDePlaces' => 5]);
        $vehicule9->setLocation("Disponible");
        $vehicule9->setImage("ford_ranger_xl.png");
        $vehicule9->setPrixJour(52);
        $manager->persist($vehicule9);

        $vehicule10= new Vehicule();
        $vehicule10->setType("Honda Fit LX");
        $vehicule10->setCaract(['Moteur' => 'GPL', 'Vitesse' => 'Manuelle', 'NombreDePlaces' => 4]);
        $vehicule10->setLocation("Disponible");
        $vehicule10->setImage("honda_fit_lx.png");
        $vehicule10->setPrixJour(88);
        $manager->persist($vehicule10);

        $vehicule11= new Vehicule();
        $vehicule11->setType("Hyundai Tucson Sport");
        $vehicule11->setCaract(['Moteur' => 'Électrique', 'Vitesse' => 'Automatique', 'NombreDePlaces' => 4]);
        $vehicule11->setLocation("Disponible");
        $vehicule11->setImage("hyundai_tucson_sport.png");
        $vehicule11->setPrixJour(76);
        $manager->persist($vehicule11);


        //Facturations
        $facturation1= new Facturation();
        $facturation1->setIdV($vehicule3);
        $facturation1->setIdC($client2);
        $facturation1->setEtat(false);
        $facturation1->getIdV()->setLocation("En location");

        $debut = new DateTime("2021-05-11");
        $fin = new DateTime("2021-05-25");
        $facturation1->setDateD($debut);
        $facturation1->setDateF($debut);
        $intervalle = $debut->diff($fin);
        $jours = $intervalle->days;
        $facturation1->setValeur($facturation1->getIdV()->getPrixJour() * $jours);
        $manager->persist($facturation1);


        $facturation2= new Facturation();
        $facturation2->setIdV($vehicule2);
        $facturation2->setIdC($client3);
        $facturation2->setEtat(false);
        $facturation2->getIdV()->setLocation("En location");

        $debut = new DateTime("2021-04-08");
        $fin = new DateTime("2021-05-28");
        $facturation2->setDateD($debut);
        $facturation2->setDateF($debut);
        $intervalle = $debut->diff($fin);
        $jours = $intervalle->days;
        $facturation2->setValeur($facturation2->getIdV()->getPrixJour() * $jours);
        $manager->persist($facturation2);


        $facturation3= new Facturation();
        $facturation3->setIdV($vehicule6);
        $facturation3->setIdC($client3);
        $facturation3->setEtat(false);
        $facturation3->getIdV()->setLocation("En location");

        $debut = new DateTime("2021-05-02");
        $fin = new DateTime("2021-05-15");
        $facturation3->setDateD($debut);
        $facturation3->setDateF($debut);
        $intervalle = $debut->diff($fin);
        $jours = $intervalle->days;
        $facturation3->setValeur($facturation3->getIdV()->getPrixJour() * $jours);
        $manager->persist($facturation3);


        $facturation4= new Facturation();
        $facturation4->setIdV($vehicule1);
        $facturation4->setIdC($client1);
        $facturation4->setEtat(false);
        $facturation4->getIdV()->setLocation("En location");

        $debut = new DateTime("2021-06-03");
        $fin = new DateTime("2021-07-03");
        $facturation4->setDateD($debut);
        $facturation4->setDateF($debut);
        $intervalle = $debut->diff($fin);
        $jours = $intervalle->days;
        $facturation4->setValeur($facturation4->getIdV()->getPrixJour() * $jours);
        $manager->persist($facturation4);
        $manager->flush();
    }
}
