<?php

namespace App\DataFixtures;

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
        $userUser = $this->createUser('user@user.com', 'user','');
        $userAdmin = $this->createUser('admin@admin.com', 'admin', 'ROLE_ADMIN');
        $userMatt = $this->createUser('matt@matt.com', 'matt', 'ROLE_SUPER_ADMIN');


        $userClient1 = $this->createUser('client1@client1.com', 'client1','ROLE_CLIENT');
        $userClient2 = $this->createUser('client2@client2.com', 'client2','ROLE_CLIENT');




        $userTrade1 = $this->createUser('trade1@trade1.com', 'trade1','ROLE_TRADEPERSON');
        $userTrade2 = $this->createUser('trade2@trade2.com', 'trade2','ROLE_TRADEPERSON');
        $userTrade3 = $this->createUser('trade3@trade3.com', 'trade3','ROLE_TRADEPERSON');





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





        $job1 = new Job();
        $job1 -> setCreator($userUser);
        $job1->setTrade($carpentry);
        $job1->setContact(434);
        $job1->setDescription('Make a bench');
        $job1->setLocation('Dublin 15');

        $job2 = new Job();
        $job2 ->setCreator($userMatt);
        $job2->setTrade($carpentry);
        $job2->setContact(435);
        $job2->setDescription('Make a chair');
        $job2->setLocation('Dublin 15');




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




        // send query to DB
        $manager->flush();

    }



    private function createUser($username, $plainPassword, $role = 'ROLE_USER'):User
    {
        $user = new User();
        $user->setEmail($username);
        $user->setRole($role);

        // password - and encoding
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        return $user;
    }
}