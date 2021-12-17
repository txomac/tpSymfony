<?php

namespace App\Service;

use App\Entity\Soiree;
use App\Repository\SoireeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class TriCountService extends AbstractController
{
    private SessionInterface $session;
    private EntityManagerInterface $manager;
    private RequestStack $requestStack;
    private SoireeRepository $soireeRepo;

    public function __construct(EntityManagerInterface $manager, SessionInterface $session, RequestStack $requestStack, SoireeRepository $soireeRepo)
    {
        $this->manager = $manager;
        $this->session = $session;
        $this->requestStack = $requestStack;
        $this->soireeRepo = $soireeRepo;
    }

    public function addUser($soiree){
        $nbrUser = $this->requestStack->getSession()->get('nbrUser');
        $nbrUser++;
        $this->session->set('nbrUser', $nbrUser);
        $soiree = $this->soireeRepo->findOneBy(['id' => $soiree]);
        $soiree->setNbrparticipants($nbrUser);
        $this->manager->persist($soiree);
        $this->manager->flush();
    }

}