<?php
namespace App\Tests;
use App\Tests\AcceptanceTester;
use Codeception\Example;



class HomePageCest
{
    public function homePageContent(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->seeInCurrentUrl('/');
        $I->see('Covid-19: Tradesmate is here to support you with essential call outs for repairs and servicing, including painting & decorating, electrical, and plumbing');
        $I->dontsee('log out');
        $I->seeLink('Login');
    }

    public function contactPageContent(AcceptanceTester $I)
    {
        $I->amOnPage('contact');
        $I->seeInCurrentUrl('/contact');
        $I->see('Contact Page');
        $I->dontsee('about page');
        $I->seeLink('Login');
    }

    public function aboutPageContent(AcceptanceTester $I)
    {
        $I->amOnPage('about');
        $I->see('About Page');
        $I->dontsee('contact page');
        $I->seeLink('Login');
        $I->seeInTitle('About Page');

    }









}