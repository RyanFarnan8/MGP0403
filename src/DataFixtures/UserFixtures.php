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
        $userUser = $this->createUser('user@user.com', 'user');
        $userAdmin = $this->createUser('admin@admin.com', 'admin', 'ROLE_ADMIN');
        $userMatt = $this->createUser('matt@matt.com', 'matt', 'ROLE_SUPER_ADMIN');
        $userClient1 = $this->createUser('client1@client1.com', 'client1','ROLE_CLIENT');
        $userClient2 = $this->createUser('client2@client2.com', 'client2','ROLE_CLIENT');
        $userTrade1 = $this->createUser('trade1@trade1.com', 'trade1','TRADESMAN');




        $carpentry = new Trade();
        $carpentry ->setTitle('carpentry');


        $plumbing = new Trade();
        $plumbing ->setTitle('plumbing');

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









        // add to DB queue
        $manager->persist($userUser);
        $manager->persist($userAdmin);
        $manager->persist($userMatt);
        $manager->persist($userClient1);
        $manager->persist($userClient2);
        $manager->persist($userTrade1);
        $manager->persist($carpentry);
        $manager->persist($plumbing);
        $manager->persist($job1);
        $manager->persist($job2);


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