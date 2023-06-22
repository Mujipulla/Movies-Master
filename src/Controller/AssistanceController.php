<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
class AssistanceController extends AbstractController
{
 
    #[Route('/assistance', name: 'app_assistance')]
    public function saveassit(Request $request,PersistenceManagerRegistry $doctrine): Response
    {
        $contact= new Contact();
        $em = $doctrine->getManager();   
        $contact->setNom($request->get('nom'));
		$contact->setFirstname($request->get('fname'));
		$contact->setEmail($request->get('email'));
		$contact->setMessage($request->get('message'));

        $em->persist($contact);
        $em->flush();
        $this->addFlash('success', "Votre message a été envoyé.");

        return $this->render('assistance/index.html.twig');
    }
}
