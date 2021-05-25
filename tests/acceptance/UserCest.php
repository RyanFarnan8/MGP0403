<?php
namespace App\Tests;

use App\Entity\User;
use Codeception\Example;
use App\Tests\AcceptanceTester;
use App\Repository\UserRepository;

class UserCest
{
    public function testUsersInDb(AcceptanceTester $I)
    {
        $I->seeInRepository('App\Entity\User', [
            'email' => 'client1@client1.com'
        ]);
        $I->seeInRepository('App\Entity\User', [
            'email' => 'trade1@trade1.com'
        ]);
        $I->seeInRepository('App\Entity\User', [
            'email' => 'admin@admin.com'
        ]);
    }


    public function testAddToDatabase(AcceptanceTester $I)
    {
// INSERT new user `userTemp@temp.com` into the User table
        $I->haveInRepository('App\Entity\User', [

            'email' => 'userTemp2@temp.com',
            'password' => 'simplepassword',
            'role' => 'ROLE_CLIENT',
            'contactNumber' => '046664564465',



        ]);
// test whether user `userTemp@temp.com` can be FOUND in the table
        $I->seeInRepository('App\Entity\User', [
            'email' => 'userTemp@temp.com',
        ]);
    }


    public function testTEMPNoLongerInDatabase(AcceptanceTester $I)
    {
// since we are RESETTING db after each test, the temporary user should NOT still be in the repository...
        $I->dontSeeInRepository('App\Entity\User', [
            'email' => 'userTemp8@temp.com',
        ]);
    }


    /**
     * @param \App\Tests\AcceptanceTester $I
     * @param Example $example
     * @example(email="client1@client1.com", password="client1")
     */
    public function validUserRoleUserCannotSeeLinkToAdminHomePage(AcceptanceTester $I, Example $example)
    {
// ARRANGE: login
        $email = $example['email'];
        $password = $example['password'];
        $this->helperLogin($I, $email, $password);
// ASSERT: NOT authorised
        $this->dontSeeAdminHomeLink($I);
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
    private function dontSeeAdminHomeLink(AcceptanceTester $I)
    {
        $I->expect('NOT to see link to admin home');
        $I->dontSeeLink('admin home');
    }








}