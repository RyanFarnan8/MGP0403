<?php

namespace App\Controller;

use App\Entity\County;
use App\Form\County1Type;
use App\Repository\CountyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/county")
 */
class CountyController extends AbstractController
{
    /**
     * @Route("/", name="county_index", methods={"GET"})
     */
    public function index(CountyRepository $countyRepository): Response
    {
        return $this->render('county/index.html.twig', [
            'counties' => $countyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="county_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $county = new County();
        $form = $this->createForm(County1Type::class, $county);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($county);
            $entityManager->flush();

            return $this->redirectToRoute('county_index');
        }

        return $this->render('county/new.html.twig', [
            'county' => $county,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="county_show", methods={"GET"})
     */
    public function show(County $county): Response
    {
        return $this->render('county/show.html.twig', [
            'county' => $county,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="county_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, County $county): Response
    {
        $form = $this->createForm(County1Type::class, $county);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('county_index');
        }

        return $this->render('county/edit.html.twig', [
            'county' => $county,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="county_delete", methods={"DELETE"})
     */
    public function delete(Request $request, County $county): Response
    {
        if ($this->isCsrfTokenValid('delete'.$county->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($county);
            $entityManager->flush();
        }

        return $this->redirectToRoute('county_index');
    }
}
