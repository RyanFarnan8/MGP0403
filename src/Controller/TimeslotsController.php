<?php

namespace App\Controller;

use App\Entity\Timeslots;
use App\Form\Timeslots1Type;
use App\Repository\TimeslotsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/timeslots")
 */
class TimeslotsController extends AbstractController
{
    /**
     * @Route("/", name="timeslots_index", methods={"GET"})
     */
    public function index(TimeslotsRepository $timeslotsRepository): Response
    {
        return $this->render('timeslots/index.html.twig', [
            'timeslots' => $timeslotsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="timeslots_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $timeslot = new Timeslots();
        $form = $this->createForm(Timeslots1Type::class, $timeslot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($timeslot);
            $entityManager->flush();

            return $this->redirectToRoute('timeslots_index');
        }

        return $this->render('timeslots/new.html.twig', [
            'timeslot' => $timeslot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="timeslots_show", methods={"GET"})
     */
    public function show(Timeslots $timeslot): Response
    {
        return $this->render('timeslots/show.html.twig', [
            'timeslot' => $timeslot,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="timeslots_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Timeslots $timeslot): Response
    {
        $form = $this->createForm(Timeslots1Type::class, $timeslot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('timeslots_index');
        }

        return $this->render('timeslots/edit.html.twig', [
            'timeslot' => $timeslot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="timeslots_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Timeslots $timeslot): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timeslot->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($timeslot);
            $entityManager->flush();
        }

        return $this->redirectToRoute('timeslots_index');
    }

}
