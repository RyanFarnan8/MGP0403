<?php

namespace App\Controller;

use App\Entity\JobApplication;
use App\Form\JobApplicationType;
use App\Repository\JobApplicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Job;

/**
 * @Route("/job_application")
 */
class JobApplicationController extends AbstractController

{


    /**
     * @Route("/accept/{id}/{job_id}", name="job_application_accept")
     */
    public function accept(JobApplication $jobApplication, Job $job): Response
    {
        $acceptedJob = new AcceptedJob();
    /*
     * Create Entity: (Accepted Job) defines Job applications properties with job properties
     *
     */

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($acceptedJob);
        $entityManager->remove($job);
        $entityManager->remove($jobApplication);
        $entityManager->flush();

        return $this->redirectToRoute('accepted_job_index');

    }
    /**
     * @Route("/", name="job_application_index", methods={"GET"})
     */
    public function index(JobApplicationRepository $jobApplicationRepository): Response
    {
        return $this->render('job_application/index.html.twig', [
            'job_applications' => $jobApplicationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="job_application_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $jobApplication = new JobApplication();

        $user = $this->getUser();




        $form = $this->createForm(JobApplicationType::class, $jobApplication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //Person who applied for the job will be set as Tradeperson who applied
            $jobApplication->setTradeperson($user);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jobApplication);
            $entityManager->flush();

            return $this->redirectToRoute('job_application_index');
        }

        return $this->render('job_application/new.html.twig', [
            'job_application' => $jobApplication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_application_show", methods={"GET"})
     */
    public function show(JobApplication $jobApplication): Response
    {
        return $this->render('job_application/show.html.twig', [
            'job_application' => $jobApplication,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="job_application_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobApplication $jobApplication): Response
    {
        $form = $this->createForm(JobApplicationType::class, $jobApplication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_application_index');
        }

        return $this->render('job_application/edit.html.twig', [
            'job_application' => $jobApplication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_application_delete", methods={"DELETE"})
     */
    public function delete(Request $request, JobApplication $jobApplication): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobApplication->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jobApplication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_application_index');
    }
}
