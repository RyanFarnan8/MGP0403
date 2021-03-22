<?php

namespace App\Controller;

use App\Entity\Trade;
use App\Form\Trade2Type;
use App\Repository\TradeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trade")
 */
class TradeController extends AbstractController
{
    /**
     * @Route("/", name="trade_index", methods={"GET"})
     */
    public function index(TradeRepository $tradeRepository): Response
    {
        return $this->render('trade/index.html.twig', [
            'trades' => $tradeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="trade_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $trade = new Trade();
        $form = $this->createForm(Trade2Type::class, $trade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trade);
            $entityManager->flush();

            return $this->redirectToRoute('trade_index');
        }

        return $this->render('trade/new.html.twig', [
            'trade' => $trade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="trade_show", methods={"GET"})
     */
    public function show(Trade $trade): Response
    {
        return $this->render('trade/show.html.twig', [
            'trade' => $trade,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="trade_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Trade $trade): Response
    {
        $form = $this->createForm(Trade2Type::class, $trade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('trade_index');
        }

        return $this->render('trade/edit.html.twig', [
            'trade' => $trade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="trade_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Trade $trade): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trade->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trade);
            $entityManager->flush();
        }

        return $this->redirectToRoute('trade_index');
    }
}
