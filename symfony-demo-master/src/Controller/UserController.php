<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use App\Entity\User;
// use App\Form\UserType;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(UserRepository $userRepository)
    {
        return $this->list_all($userRepository);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list_all(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/user/create", name="user_create")
     */
    public function create(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // entityManager => persist ???
            $entityManager->persist($user);
            $entityManager->flush();
            // TODO: check if the following line works
            return $this->redirectToRoute('user/show', $user);
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/id/{id}", name="user_id")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function id(User $user)
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/user/profile/{firstname}", name="user_profile")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profile(User $user)
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
    /**
     * @Route("/user/firstname/{byFirstname}", name="user_firstname")
     * @ParamConverter("user", options={"mapping": {"byFirstname": "firstname"}})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function firstname(User $user)
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }
}
