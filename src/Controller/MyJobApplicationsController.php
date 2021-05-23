<?php

namespace App\Controller;

use App\Entity\MyJobApplications;
use App\Form\MyJobApplicationsType;
use App\Repository\MyJobApplicationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/my/job/applications")
 */
class MyJobApplicationsController extends AbstractController
{
    /**
     * @Route("/", name="my_job_applications_index", methods={"GET"})
     */
    public function index(MyJobApplicationsRepository $myJobApplicationsRepository): Response

    {
        $user = $this->getUser();
        $template = 'my_job_applications/index.html.twig';

        $args = [
            'my_job_applications' => $myJobApplicationsRepository->findAll(),
        ];
        return $this->render($template, $args);
    }



    /**
     * @Route("/new", name="my_job_applications_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $myJobApplication = new MyJobApplications();
        $form = $this->createForm(MyJobApplicationsType::class, $myJobApplication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($myJobApplication);
            $entityManager->flush();

            return $this->redirectToRoute('my_job_applications_index');
        }

        return $this->render('my_job_applications/new.html.twig', [
            'my_job_application' => $myJobApplication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="my_job_applications_show", methods={"GET"})
     */
    public function show(MyJobApplications $myJobApplication): Response
    {
        return $this->render('my_job_applications/show.html.twig', [
            'my_job_application' => $myJobApplication,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="my_job_applications_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MyJobApplications $myJobApplication): Response
    {
        $form = $this->createForm(MyJobApplicationsType::class, $myJobApplication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('my_job_applications_index');
        }

        return $this->render('my_job_applications/edit.html.twig', [
            'my_job_application' => $myJobApplication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="my_job_applications_delete", methods={"POST"})
     */
    public function delete(Request $request, MyJobApplications $myJobApplication): Response
    {
        if ($this->isCsrfTokenValid('delete'.$myJobApplication->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($myJobApplication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('my_job_applications_index');
    }
}
