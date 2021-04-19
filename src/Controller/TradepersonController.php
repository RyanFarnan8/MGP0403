<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class TradepersonController extends AbstractController
{
    /**
     * @Route("/tradeperson", name="tradeperson")
     * @IsGranted("ROLE_TRADEPERSON")
     */

    public function index(): Response
    {
        return $this->render('tradeperson/index.html.twig', [
            'controller_name' => 'TradepersonController',
        ]);
    }

    /**
     * @Route("/viewTradeProfile", name="viewTradeProfile")
     */
    public function viewTradeProfile(): Response
    {
        return $this->render('tradeperson/viewProfile.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

}
