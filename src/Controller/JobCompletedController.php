<?php

namespace App\Controller;

use App\Entity\JobCompleted;
use App\Form\JobCompletedType;
use App\Repository\JobCompletedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



/**
 * @Route("/job_completed")
 *@Security("is_granted('ROLE_CLIENT') or is_granted('ROLE_TRADEPERSON')")
 */



class JobCompletedController extends AbstractController
{
    /**
     * @Route("/", name="job_completed_index", methods={"GET"})
     */
    public function index(JobCompletedRepository $jobCompletedRepository): Response
    {

        $user = $this->getUser();
        $template = 'job_completed/index.html.twig';
        $jobs = $jobCompletedRepository->findByTradePerson($user);
        $args = [
            'job_completeds' => $jobs
        ];
        return $this->render( $template, $args  );
    }

    /**
     * @Route("/new", name="job_completed_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jobCompleted = new JobCompleted();
        $form = $this->createForm(JobCompletedType::class, $jobCompleted);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jobCompleted);
            $entityManager->flush();

            return $this->redirectToRoute('job_completed_index');
        }

        return $this->render('job_completed/new.html.twig', [
            'job_completed' => $jobCompleted,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_completed_show", methods={"GET"})
     */
    public function show(JobCompleted $jobCompleted): Response
    {
        return $this->render('job_completed/show.html.twig', [
            'job_completed' => $jobCompleted,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="job_completed_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobCompleted $jobCompleted): Response
    {
        $form = $this->createForm(JobCompletedType::class, $jobCompleted);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_completed_index');
        }

        return $this->render('job_completed/edit.html.twig', [
            'job_completed' => $jobCompleted,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_completed_delete", methods={"DELETE"})
     */
    public function delete(Request $request, JobCompleted $jobCompleted): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobCompleted->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jobCompleted);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_completed_index');
    }
}
