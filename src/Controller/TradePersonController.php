<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TradePersonController extends AbstractController
{
    /**
     * @Route("/trade/person", name="trade_person")
     */
    public function index(): Response
    {
        return $this->render('trade_person/index.html.twig', [
            'controller_name' => 'TradePersonController',
        ]);
    }
}
