<?php

namespace App\Controller;

use App\Entity\Soiree;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TriCountController extends AbstractController
{
    private SessionInterface $session;
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager, SessionInterface $session)
    {
        $this->manager = $manager;
        $this->session = $session;
    }

    #[Route('/tricount', name: 'tri_count')]
    public function commencer(): Response
    {

        return $this->render('tri_count/commencer.html.twig', [

        ]);
    }

    #[Route('/tricount/soiree_init', name: 'soiree_init')]
    public function soireeInit(): Response
    {
        $soiree = new Soiree();
        $soiree->setNbrparticipants(3);
        $this->manager->persist($soiree);
        $this->manager->flush();
        return $this->redirectToRoute('create', [
            'id'=>$soiree->getId(),
        ]);
    }

    #[Route('/tricount/create/{id}', name: 'create')]
    public function create(): Response
    {

        return $this->render('tri_count/create.html.twig', [

        ]);
    }
}
