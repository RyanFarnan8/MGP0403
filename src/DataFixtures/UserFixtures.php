<?php

namespace App\DataFixtures;

use App\Entity\JobApplication;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Job;
use App\Entity\Trade;
use App\Entity\County;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // create objects
        $userUser = $this->createUser('user@user.com', 'user','0863432421');
        $userAdmin = $this->createUser('admin@admin.com', 'admin','0895463867', 'ROLE_ADMIN');
        $userMatt = $this->createUser('matt@matt.com', 'matt', '0835779567','ROLE_SUPER_ADMIN');


        $userClient1 = $this->createUser('client1@client1.com', 'client1','0831234567','ROLE_CLIENT');
        $userClient2 = $this->createUser('client2@client2.com', 'client2','0873406521','ROLE_CLIENT');
        $userClient3 = $this->createUser('client3@client3.com', 'client3','0839888967','ROLE_CLIENT');
        $userClient4 = $this->createUser('client4@client4.com', 'client4','0834254660','ROLE_CLIENT');
        $userClient5 = $this->createUser('client5@client5.com', 'client5','0863435000','ROLE_CLIENT');
        $userClient6 = $this->createUser('client6@client6.com', 'client6','0852343567','ROLE_CLIENT');




        $userTrade1 = $this->createUser('trade1@trade1.com', 'trade1','0896534567','ROLE_TRADEPERSON');
        $userTrade2 = $this->createUser('trade2@trade2.com', 'trade2','0830297567','ROLE_TRADEPERSON');
        $userTrade3 = $this->createUser('trade3@trade3.com', 'trade3','0831908769','ROLE_TRADEPERSON');





        $carpentry = new Trade();
        $carpentry ->setTitle('Carpentry');


        $plumbing = new Trade();
        $plumbing ->setTitle('Plumbing');


        $paint = new Trade();
        $paint ->setTitle('Paint & Decor');

        $gardening = new Trade();
        $gardening ->setTitle('Gardening');

        $electrical = new Trade();
        $electrical->setTitle('Electrical');

        $locksmith = new Trade();
        $locksmith->setTitle('Locksmith');


        $notrade = new Trade();
        $notrade->setTitle('Not a tradeperson');





        $job1 = new Job();
        $job1 -> setCreator($userClient1);
        $job1->setTrade($carpentry);
        $job1->setDescription('Fit a kitchen into the canteen');
        $job1->setContact('0857567346');
        $job1->setLocation('Lidl Clonee , Clonee Village');

        $job2 = new Job();
        $job2 ->setCreator($userClient2);
        $job2->setTrade($carpentry);
        $job2->setContact('0844545346');
        $job2->setDescription('Build a custom walk in wardrobe');
        $job2->setLocation('76 Talbot St.');


        $job3 = new Job();
        $job3 ->setCreator($userClient3);
        $job3->setTrade($paint);
        $job3->setContact('0834545346');
        $job3->setDescription('Paint a cafe approx 80m2');
        $job3->setLocation('Cork City Industrial Estate, Cobh St.');

        $job4 = new Job();
        $job4 ->setCreator($userClient4);
        $job4->setTrade($locksmith);
        $job4->setContact('0836879867');
        $job4->setDescription('Replace Front and Hall Door locks . ASAP');
        $job4->setLocation('Contact me privately for my address');

        $job5 = new Job();
        $job5 ->setCreator($userClient5);
        $job5->setTrade($plumbing);
        $job5->setContact('087043238534');
        $job5->setDescription('Install new boiler');
        $job5->setLocation('33 Balinasloe St.');

        $jobApplication1 = new JobApplication();
        $jobApplication1->setPrice(110);
        $jobApplication1->setJob($job1);
        $jobApplication1->setTradeperson($userTrade2);

        $jobApplication2 = new JobApplication();
        $jobApplication2->setPrice(200);
        $jobApplication2->setJob($job2);
        $jobApplication2->setTradeperson($userTrade1);

        $jobApplication3 = new JobApplication();
        $jobApplication3->setPrice(650);
        $jobApplication3->setJob($job3);
        $jobApplication3->setTradeperson($userTrade1);


        $jobApplication4 = new JobApplication();
        $jobApplication4->setPrice(350);
        $jobApplication4->setJob($job4);
        $jobApplication4->setTradeperson($userTrade2);

        $jobApplication5 = new JobApplication();
        $jobApplication5->setPrice(1000);
        $jobApplication5->setJob($job5);
        $jobApplication5->setTradeperson($userTrade2);





        $county1 = new County();
        $county1->setCounty('Antrim');

        $county2 = new County();
        $county2->setCounty('Armagh');

        $county3 = new County();
        $county3->setCounty('Carlow');

        $county4 = new County();
        $county4->setCounty('Cavan');

        $county5 = new County();
        $county5->setCounty('Clare');

        $county6 = new County();
        $county6->setCounty('Cork');

        $county7 = new County();
        $county7->setCounty('Derry');

        $county8 = new County();
        $county8->setCounty('Donegal');

        $county9 = new County();
        $county9->setCounty('Down');

        $county10 = new County();
        $county10->setCounty('Dublin');

        $county11= new County();
        $county11->setCounty('Fermanagh');

        $county12 = new County();
        $county12->setCounty('Galway');

        $county13 = new County();
        $county13->setCounty('Kerry');

        $county14 = new County();
        $county14->setCounty('Kildare');

        $county15 = new County();
        $county15->setCounty('Kilkenny');

        $county16 = new County();
        $county16->setCounty('Laois');

        $county17 = new County();
        $county17->setCounty('Leitrim');

        $county18 = new County();
        $county18->setCounty('Limerick');

        $county19 = new County();
        $county19->setCounty('Longford');

        $county20 = new County();
        $county20->setCounty('Louth');

        $county21 = new County();
        $county21->setCounty('Mayo');

        $county22 = new County();
        $county22->setCounty('Meath');

        $county23 = new County();
        $county23->setCounty('Monaghan');

        $county24 = new County();
        $county24->setCounty('Offaly');

        $county25 = new County();
        $county25->setCounty('Roscommon');

        $county26 = new County();
        $county26->setCounty('Sligo');

        $county27 = new County();
        $county27->setCounty('Tipperary');

        $county28 = new County();
        $county28->setCounty('Tyrone');

        $county29 = new County();
        $county29->setCounty('Waterford');

        $county30 = new County();
        $county30->setCounty('Westmeath');

        $county31 = new County();
        $county31->setCounty('Wexford');

        $county32 = new County();
        $county32->setCounty('Wicklow');









        // add to DB queue
        $manager->persist($userUser);
        $manager->persist($userAdmin);
        $manager->persist($userMatt);


        $manager->persist($userClient1);
        $manager->persist($userClient2);
        $manager->persist($userClient3);
        $manager->persist($userClient4);
        $manager->persist($userClient5);
        $manager->persist($userClient6);


        $manager->persist($userTrade1);
        $manager->persist($userTrade2);
        $manager->persist($userTrade3);



        $manager->persist($carpentry);
        $manager->persist($plumbing);
        $manager->persist($gardening);
        $manager->persist($paint);
        $manager->persist($locksmith);
        $manager->persist($electrical);


        $manager->persist($job1);
        $manager->persist($job2);
        $manager->persist($job3);
        $manager->persist($job4);
        $manager->persist($job5);

        $manager->persist($county1);
        $manager->persist($county2);
        $manager->persist($county3);
        $manager->persist($county4);
        $manager->persist($county5);
        $manager->persist($county6);
        $manager->persist($county7);
        $manager->persist($county8);
        $manager->persist($county9);
        $manager->persist($county10);
        $manager->persist($county11);
        $manager->persist($county12);
        $manager->persist($county13);
        $manager->persist($county14);
        $manager->persist($county15);
        $manager->persist($county16);
        $manager->persist($county17);
        $manager->persist($county18);
        $manager->persist($county19);
        $manager->persist($county20);
        $manager->persist($county21);
        $manager->persist($county22);
        $manager->persist($county23);
        $manager->persist($county24);
        $manager->persist($county25);
        $manager->persist($county26);
        $manager->persist($county27);
        $manager->persist($county28);
        $manager->persist($county29);
        $manager->persist($county30);
        $manager->persist($county31);
        $manager->persist($county32);

        $manager->persist($jobApplication1);
        $manager->persist($jobApplication2);
        $manager->persist($jobApplication3);
        $manager->persist($jobApplication4);
        $manager->persist($jobApplication5);



        // send query to DB
        $manager->flush();

    }



    private function createUser($username, $plainPassword,$contact, $role = 'ROLE_USER'):User
    {
        $user = new User();
        $user->setEmail($username);
        $user->setRole($role);
        $user->setContactNumber($contact);

        // password - and encoding
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        return $user;
    }


}