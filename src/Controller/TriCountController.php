<?php

namespace App\Controller;

use App\Entity\Soiree;
use App\Entity\User;
use App\Repository\SoireeRepository;
use App\Service\TriCountService;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class TriCountController extends AbstractController
{
    private SessionInterface $session;
    private EntityManagerInterface $manager;
    private RequestStack $requestStack;
    private TriCountService $service;
    private SoireeRepository $soireeRepo;

    public function __construct(EntityManagerInterface $manager, SessionInterface $session, RequestStack $requestStack, TriCountService $service, SoireeRepository $soireeRepo)
    {
        $this->manager = $manager;
        $this->session = $session;
        $this->requestStack = $requestStack;
        $this->service = $service;
        $this->soireeRepo = $soireeRepo;
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
        $this->session->set('soiree', $soiree->getId());
        $this->session->set('nbrUser', $soiree->getNbrparticipants());
        return $this->redirectToRoute('create', [
            'id'=>$this->requestStack->getSession()->get('soiree'),
        ]);
    }

    #[Route('/tricount/create/{id}', name: 'create')]
    public function create(Request $request): Response
    {
        $form = $this->createForm(UserType::class, null, [
           'nbrUser'=>$this->requestStack->getSession()->get('nbrUser'),
        ]);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ){
            $users = $form->getData();
            $countUsers =count($users)/2;
            for ($i = 1 ; $i <= $countUsers ; $i++){
                $user = new User;
                $user->setIdSoiree($this->soireeRepo->findOneBy(['id' => $this->requestStack->getSession()->get('soiree')]));
                $user->setNom($users['nom'.$i]);
                $user->setDepenses($users['depenses'.$i]);
                if( $i == 1 ){
                $user->setIsOrganisateur(true);
                }
                $this->manager->persist($user);
                $this->manager->flush($user);
            }
            return $this->redirectToRoute('home',[

                ]);
        }
        return $this->render('tri_count/create.html.twig',[
            'nbrUser'=>$this->requestStack->getSession()->get('nbrUser'),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/tricount/addUser', name: 'addUser')]
    public function addUser(): Response
    {
        $id = $this->requestStack->getSession()->get('soiree');
        $this->service->addUser($id);
        return $this->redirectToRoute('create', [
            'id'=>$id,
        ]);
    }
}
