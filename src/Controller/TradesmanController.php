<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/tradesman", name="tradesman")
 * @IsGranted("ROLE_TRADESMAN")
 */

class TradesmanController extends AbstractController
{
    /**
     * @Route("/tradesman", name="tradesman")
     */
    public function index(): Response
    {
        return $this->render('tradesman/index.html.twig', [
            'controller_name' => 'TradesmanController',
        ]);
    }
}
