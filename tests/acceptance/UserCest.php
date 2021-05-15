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

            'email' => 'userTemp@temp.com',
            'password' => 'simplepassword',
            'role' => 'ROLE_CLIENT',
            'contact_number' => '46664564465',


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
            'email' => 'userTemp@temp.com',
        ]);
    }


    /**
     * @param \App\Tests\AcceptanceTester $I
     * @param Example $example
     * @example(email="user@user.com", password="user")
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


}