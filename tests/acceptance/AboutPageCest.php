<?php
namespace App\Tests;
use App\Tests\AcceptanceTester;


class AboutPageCest
{
    public function aboutPageContent(AcceptanceTester $I)
    {
        $I->amOnPage('about');
        $I->see('Why Tradesmate?');
        $I->dontsee('contact page');
        $I->seeLink('Log In');


    }

    public function faqPageContent(AcceptanceTester $I)
    {
        $I->amOnPage('faq');
        $I->see('Frequently Asked Questions');
        $I->dontsee('contact page');
        $I->seeLink('Log In');


    }
}
