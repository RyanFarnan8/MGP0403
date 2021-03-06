<?php

namespace App\Controller;

use App\Repository\JobRepository;
use App\Repository\TradeRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(TradeRepository $tradeRepository): Response
    {
        $template = 'default/index.html.twig';
        $args = [
            'trade'=>$tradeRepository->findAll()
        ];
        return $this->render($template, $args);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        $template = 'default/about.html.twig';
        $args = [];
        return $this->render($template, $args);
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        $template = 'default/contact.html.twig';
        $args = [];
        return $this->render($template, $args);
    }

    /**
     * @Route("/paint", name="paint")
     */
    public function paint(JobRepository $jobRepository): Response
    {
        $template = 'default/paint.html.twig';
        $args = [
            'job'=>$jobRepository->findAll()

        ];
        return $this->render($template, $args);
    }

    /**
     * @Route("/plumbing", name="plumbing")
     */
    public function plumbing(UserRepository $userRepository): Response
    {
        $template = 'default/plumbing.html.twig';
        $args = [
            'users'=>$userRepository->findAll()

        ];
        return $this->render($template, $args);
    }

    /**
     * @Route("/carpentry", name="carpentry")
     */
    public function carpentry(JobRepository $jobRepository): Response
    {
        $template = 'default/carpentry.html.twig';
        $args = [
            'job'=>$jobRepository->findAll()

        ];
        return $this->render($template, $args);
    }



    /**
     * @Route("/electrical", name="electrical")
     */
    public function electrical(JobRepository $jobRepository): Response
    {
        $template = 'default/electrical.html.twig';
        $args = [
            'job'=>$jobRepository->findAll()

        ];
        return $this->render($template, $args);
    }


    /**
     * @Route("/gallery", name="gallery")
     */
    public function gallery(JobRepository $jobRepository): Response
    {
        $template = 'default/gallery.html.twig';
        $args = [];
        return $this->render($template, $args);
    }

    /**
     * @Route("/locksmith", name="locksmith")
     */
    public function locksmith(JobRepository $jobRepository): Response
    {
        $template = 'default/locksmith.html.twig';
        $args = [
            'job'=>$jobRepository->findAll()

        ];
        return $this->render($template, $args);
    }


    /**
     * @Route("/gardening", name="gardening")
     */
    public function gardening(JobRepository $jobRepository): Response
    {
        $template = 'default/gardening.html.twig';
        $args = [
            'job'=>$jobRepository->findAll()

        ];
        return $this->render($template, $args);
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction()
    {
        $request = $this->getRequest();
        $data = $request->request->get('search');


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p FROM FooTransBundle:Suplier p
    WHERE p.name LIKE :data')
            ->setParameter('data', $data);


        $res = $query->getResult();

        return $this->render('FooTransBundle:Default:search.html.twig', array(
            'res' => $res));
    }
    /**
     * @Route("/apply", name="apply")
     */
    public function apply(): Response
    {
        $template = 'default/jobPostedSuccessfully.html.twig';
        $args = [];
        return $this->render($template, $args);
    }

    /**
     * @Route("/favourites", name="favourites")
     */
    public function favourites(): Response
    {
        $template = 'default/favourites.html.twig';
        $args = [
        ];
        return $this->render($template, $args);
    }

    /**
     * @Route("/job_Posted_Successfully", name="jobPostedSuccessfully")
     */
    public function jobPostedSuccessfully(): Response
    {
        $template = 'default/jobPostedSuccessfully.html.twig';
        $args = [];
        return $this->render($template, $args);
    }

    /**
     * @Route("/job_Application_Successfully", name="jobApplicationSuccessfully")
     */
    public function jobApplicationSuccessfully(): Response
    {
        $template = 'default/jobApplicationSuccessfully.html.twig';
        $args = [];
        return $this->render($template, $args);
    }


}
