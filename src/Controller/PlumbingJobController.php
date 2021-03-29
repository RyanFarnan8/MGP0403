<?php

namespace App\Controller;

use App\Entity\PlumbingJob;
use App\Form\PlumbingJobType;
use App\Repository\PlumbingJobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plumbing/job")
 */
class PlumbingJobController extends AbstractController
{
    /**
     * @Route("/", name="plumbing_job_index", methods={"GET"})
     */
    public function index(PlumbingJobRepository $plumbingJobRepository): Response
    {
        return $this->render('plumbing_job/index.html.twig', [
            'plumbing_jobs' => $plumbingJobRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="plumbing_job_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $plumbingJob = new PlumbingJob();
        $form = $this->createForm(PlumbingJobType::class, $plumbingJob);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plumbingJob);
            $entityManager->flush();

            return $this->redirectToRoute('plumbing_job_index');
        }

        return $this->render('plumbing_job/new.html.twig', [
            'plumbing_job' => $plumbingJob,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plumbing_job_show", methods={"GET"})
     */
    public function show(PlumbingJob $plumbingJob): Response
    {
        return $this->render('plumbing_job/show.html.twig', [
            'plumbing_job' => $plumbingJob,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="plumbing_job_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlumbingJob $plumbingJob): Response
    {
        $form = $this->createForm(PlumbingJobType::class, $plumbingJob);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plumbing_job_index');
        }

        return $this->render('plumbing_job/edit.html.twig', [
            'plumbing_job' => $plumbingJob,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plumbing_job_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlumbingJob $plumbingJob): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plumbingJob->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plumbingJob);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plumbing_job_index');
    }
}
