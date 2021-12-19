<?php

namespace App\Service;

use App\Entity\Soiree;
use App\Entity\User;
use App\Repository\SoireeRepository;
use App\Repository\UserRepository;
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
    private UserRepository $userRepo;

    public function __construct(EntityManagerInterface $manager, SessionInterface $session, RequestStack $requestStack, SoireeRepository $soireeRepo, UserRepository $userRepo)
    {
        $this->manager = $manager;
        $this->session = $session;
        $this->requestStack = $requestStack;
        $this->soireeRepo = $soireeRepo;
        $this->userRepo = $userRepo;
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

    public function update($soireeId)
    {
        $soiree = $this->soireeRepo->findOneBy(['id' => $soireeId]);
        $users = $this->userRepo->findBy(['id_soiree' => $soireeId]);

        $moneySpent = null;
        foreach ($users as $user) {
            $moneySpent += round($user->getDepenses());
        }
        $soiree->setTotalSoiree($moneySpent);
        $averagePerUser = round($moneySpent) / round(count($users));
        $soiree->setMoyenneUtilisateur(round($averagePerUser));
        $soiree->setNbrparticipants(count($users));
        $this->manager->persist($soiree);
        foreach ($users as $user) {
            $expenses = round($user->getDepenses());
            $averagePerUser = round($soiree->getMoyenneUtilisateur());
            $debts = $averagePerUser - $expenses;
            $user->setDettes(round($debts));
            $this->manager->persist($user);
        }
        $this->manager->flush();
        return 1;
    }

    public function tri($soireeId)
    {
        $soiree = $this->soireeRepo->findOneBy(['id' => $soireeId]);
        $users = $this->userRepo->findBy(['id_soiree' => $soireeId],['dettes' => 'ASC']);
        $nbUsers = $soiree->getNbrparticipants();
        $nbUsers--;
        $count = 0;
        $max = $nbUsers;
        $tri = [];
        while ($count != $nbUsers){
            $user1 = $users[$count];
            if ($max<0){
                break;
            }
            $user2 = $users[$max];
            $max--;
            $user1debts = $user1->getDettes();
            $user2debts = $user2->getDettes();
            if ($user2debts != 0) {
                array_push($tri, "" . $user2->getNom() . " doit donner " . $user2debts . " à " . $user1->getNom() . ".");
            }
            $usersDebt = round($user1debts) + round($user2debts);
            $user1->setDettes($usersDebt);
            $user2->setDettes(0);
            if ($usersDebt>=0){
                $count++;
            }
        }
        return($tri);
    }

}