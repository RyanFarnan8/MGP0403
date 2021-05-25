<?php
namespace App\Tests;
use App\Tests\AcceptanceTester;


class ContactPageCest
{
    public function contactPageContent(AcceptanceTester $I)
    {
        $I->amOnPage('contact');
        $I->seeInCurrentUrl('/contact');
        $I->see('Contact Page');
        $I->dontsee('about page');
        $I->seeLink('Log In');
    }
}
