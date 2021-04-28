<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     * @IsGranted("ROLE_CLIENT")
     */

    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }


    /**
     * @Route("/viewProfile", name="viewProfile")
     */
    public function viewProfile(UserRepository $userRepository): Response
    {
        return $this->render('client/viewProfile.html.twig', [
        ]);
    }










}
