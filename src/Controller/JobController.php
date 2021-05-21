<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\Job1Type;
use App\Repository\JobRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CountyRepository;
use App\Entity\JobCompleted;
use App\Entity\User;


/**
 * @Route("/job")
 */

class JobController extends AbstractController
{


    /**
     * @Route("/searchCounty", name="search_county", methods={"POST"})
     */
    public function searchCounty(JobRepository $jobRepository , Request $request ,CountyRepository $countyRepository): Response
    {
        $countyName = $request-> request -> get('county');
        $county = $countyRepository->findByLikeCounty($countyName);
        $jobs = $jobRepository->findByCounty($county);
        $template ='job/index.html.twig';
        $args =
            [
                'jobs' => $jobs,
                'search_text'=>$countyName
            ];
        return $this->render($template,$args);
    }



    /**
     * @Route("/", name="job_index", methods={"GET"})
     */
    public function index(JobRepository $jobRepository): Response
    {
        return $this->render('job/index.html.twig', [
            'jobs' => $jobRepository->findAll(),
        ]);
    }

    /**
     * @Route("/client_index/{id}", name="job_client_index", methods={"GET"})
     */
    public function clientIndex(User $user , JobRepository $jobRepository): Response
    {

        $template = 'job/index.html.twig';
        $args = [
            'jobs' => $jobRepository->findByCreator($user)
        ];
        return $this->render($template ,$args);
    }

    /**
     * @Route("/new", name="job_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $job = new Job();
        $user = $this->getUser();

        







        $form = $this->createForm(Job1Type::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash('success', 'Job has been posted!');


            $job->setCreator($user);

            $job->setContact($user->getContactNumber());



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($job);
            $entityManager->flush();

            return $this->redirectToRoute('jobPostedSuccessfully');
        }

        return $this->render('job/new.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/completed/{id}", name="job_completed", methods={"GET"})
     */
    public function completed(Job $job,JobRepository $jobRepository, Request $request ): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $jobCompleted = new JobCompleted();
        $jobCompleted ->setDescription($job->getDescription());
        $jobCompleted ->setCreator($job->getCreator());


        $entityManager->persist($jobCompleted);
        $entityManager->remove($job);
        $entityManager->flush();

            return $this->redirectToRoute('job_index');
    }

    /**
     * @Route("/assigned/{id}", name="job_assigned", methods={"GET"})
     */
    public function assigned(Job $job,JobRepository $jobRepository, Request $request ): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $jobAssigned = new JobAssigned();
        $jobAssigned ->setDescription($job->getDescription());
        $jobAssigned ->setCreator($job->getCreator());


        $entityManager->persist($jobAssigned);
        $entityManager->remove($job);
        $entityManager->flush();

            return $this->redirectToRoute('job_index');
    }

//    /**
//     * @Route("/job_completed/{job_id}", name="job_completed", methods={"GET"})
//     */
//    public function JobCompleted($job_id,JobRepository $jobRepository, Request $request ): Response
//    {
//        $job = $jobRepository->find($job_id);
//        $entityManager = $this->getDoctrine()->getManager();
//        $jobCompleted = new JobCompleted();
//        $jobCompleted ->setDescription($job->getDescription());
//        $jobCompleted ->setCreator($job->getCreator());
//
//
//        $entityManager->persist($jobCompleted);
//        $entityManager->remove($job);
//        $entityManager->flush();
//
//        return $this->redirectToRoute('job_index');
//    }

    /**
     * @Route("/{id}", name="job_show", methods={"GET"})
     */
    public function show(Job $job): Response
    {

        $jobApplications = $job->getJobApplications();

        $template = 'job/show.html.twig';

        $args=[
            'job' => $job,
            'job_applications' => $jobApplications,

        ];


        return $this->render('job/show.html.twig', $args);
    }

    /**
     * @Route("/{id}/edit", name="job_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Job $job): Response
    {
        $form = $this->createForm(Job1Type::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_index');
        }

        return $this->render('job/edit.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Job $job): Response
    {
        if ($this->isCsrfTokenValid('delete'.$job->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($job);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_index');
    }
}
