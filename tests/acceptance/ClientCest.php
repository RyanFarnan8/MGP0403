<?php
namespace App\Tests;

use App\Entity\User;
use Codeception\Example;
use App\Tests\AcceptanceTester;
use App\Repository\UserRepository;

class ClientCest
{


    /**
     * @param \App\Tests\AcceptanceTester $I
     * @param Example $example
     * @example(email="client1@client1.com", password="client1")
     */
    public function CanSeeLinkToViewProfilePage(AcceptanceTester $I, Example $example)
    {
// ARRANGE: login
        $email = $example['email'];
        $password = $example['password'];
        $this->helperLogin($I, $email, $password);
// ASSERT: NOT authorised



    }

    private function helperLogin(AcceptanceTester $I, $email, $password)
    {
        $I->amOnPage('/login');
        $I->expect('redirect to Login page');
        $I->seeCurrentUrlEquals('/login');
        $I->fillField('#inputEmail', $email);
        $I->fillField('#inputPassword', $password);
        $I->click('Log In');

        // successful login
        $I->dontSee('Email could not be found.');
        $I->dontSee('Invalid credentials.');

    }


    // PRIVATE - this is a "helper" method, NOT called by Codeception
    /**
     * ASSERT - do NOT see admin home link
     */
    private function CanSeeViewProfileLink(AcceptanceTester $I)
    {
        $I->expect('To see link to jobs');
        $I->canSeeLink('View Profile');
    }




}