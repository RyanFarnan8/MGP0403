<?php

namespace App\Controller;

use App\Entity\JobAssigned;
use App\Form\JobAssignedType;
use App\Repository\JobAssignedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

//* @Security("is_granted('ROLE_CLIENT') or is_granted('ROLE_TRADEPERSON') or is_granted('ROLE_ADMIN')
/**
 * @Route("/job/assigned")

 */


class JobAssignedController extends AbstractController
{
    /**
     * @Route("/", name="job_assigned_index", methods={"GET"})
     */
    public function index(JobAssignedRepository $jobAssignedRepository): Response
    {
        $user = $this->getUser();
        $template = 'job_assigned/index.html.twig';
        $jobs = $jobAssignedRepository->findByTradePerson($user);

        $args = [
            'job_assigneds' => $jobs
        ];
        return $this->render( $template, $args  );
    }


    /**
     * @Route("/new", name="job_assigned_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jobAssigned = new JobAssigned();
        $form = $this->createForm(JobAssignedType::class, $jobAssigned);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jobAssigned);
            $entityManager->flush();

            return $this->redirectToRoute('job_assigned_index');
        }

        return $this->render('job_assigned/new.html.twig', [
            'job_assigned' => $jobAssigned,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_assigned_show", methods={"GET"})
     */
    public function show(JobAssigned $jobAssigned): Response
    {
        return $this->render('job_assigned/show.html.twig', [
            'job_assigned' => $jobAssigned,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="job_assigned_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobAssigned $jobAssigned): Response
    {
        $form = $this->createForm(JobAssignedType::class, $jobAssigned);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_assigned_index');
        }

        return $this->render('job_assigned/edit.html.twig', [
            'job_assigned' => $jobAssigned,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_assigned_delete", methods={"DELETE"})
     */
    public function delete(Request $request, JobAssigned $jobAssigned): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobAssigned->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jobAssigned);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_assigned_index');
    }


}
