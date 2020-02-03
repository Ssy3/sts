<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Carbon\Carbon;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSupervisorCanLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login');
            $browser->clickLink('Admin');
            $browser->type('email', env('TEST_SUPERVISOR_ROLE_USER'));
            $browser->type('password', env('TEST_SUPERVISOR_ROLE_PASSWORD'));
            // $browser->pause(3000);
            $browser->press('LOGIN');
            // $browser->pause(3000);
            $browser->assertPathIs('/');
        });
    }

    public function testSupervisorCreateTicketInHisGroup()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ticket');
            $browser->waitFor('.create-ticket-button');
            $browser->clickLink('Create Ticket');
            $browser->visit('/ticket/create');
            $browser->type('ticket_title', 'test ticket ' . Carbon::now()->toDateTimeString());
            // $browser->type('ticket_content', 'test content');
            // $browser->script("CKEDITOR.instances['ticket_content'].insertHtml(content);");
            // $browser->waitFor('#cke_contentEditor');
            // $browser->type('ticket_content', 'test content');

            // $browser->value('#contentEditor', 'value');

            // $browser->driver->switchTo()->frame('#cke_1_contents > iframe');
            // $browser->script("document.querySelector( '#cke_1_contents iframe.cke_wysiwyg_frame' );");
            // $browser->script("$('body > p').append('Appended text');");
            $browser->script("CKEDITOR.instances['contentEditor'].setData('Test Data');");
            // $browser->fillHidden('ticket_content', 'test content');
            $browser->pause(3000);
        //     $browser        ->withinFrame('iframe[name=stripe_checkout_app]', function($browser){
        //     $browser->pause(3000);
        //     $browser->keys('input[placeholder="Email"]', 'tushar@5balloons.info')
        //         ->keys('input[placeholder="Card number"]', '4242 4242 4242 4242')
        //         ->keys('input[placeholder="MM / YY"]', '0122')
        //         ->keys('input[placeholder="CVC"]', '123')
        //         ->press('button[type="submit"')
        //         ->waitUntilMissing('iframe[name=stripe_checkout_app]');
        // });

            // $browser->click('.cke_wysiwyg_frame');
            // $browser->type('.cke_wysiwyg_frame', 'test content');
            // $browser->script("'tinyMCE.get(\'description\').setContent(\'<h1>Test Description</h1>\')'");
            $browser->select('region','1');
            $browser->waitFor('.group');
            // $browser->press('Jeddah');
            // $browser->press('ITS-J');
            // $browser->click('.group');
            $browser->select('group_id','1');
            // $browser->clickLink('test');
            // $browser->select('2', 'location_id');
            // $browser->select('4', 'category_id');
            // $browser->clickLink('ITS-J');
            $browser->select('group_id', '4');
            $browser->waitFor('#locationDiv');
            $browser->select('location_id', '2');
            $browser->waitFor('#categoryDiv');
            $browser->select('category_id', '4');
            // $browser->clickLink('test');
            // $browser->select('2', 'location_id');
            // $browser->select('4', 'category_id');
            // $browser->script("CKEDITOR.instances.contentEditor.insertHtml( '<p>This is a new paragraph.</p>' );");
            // $browser->fillHidden('ticket_content', 'test content');
            $browser->press('Create')
                    ->assertSee('Comments')
                    ->screenshot('home-page');
        });
    }

    public function testSupervisorCreateTicketInOtherGroup()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ticket/create');
            // $browser->waitFor('.create-ticket-button');
            // $browser->clickLink('Create Ticket');
            $browser->visit('/ticket/create');
            $browser->type('ticket_title', 'test ticket in other group ' . Carbon::now()->toDateTimeString());
            // $browser->type('ticket_content', 'test content');
            // $browser->script("CKEDITOR.instances['ticket_content'].insertHtml(content);");
            // $browser->waitFor('#cke_contentEditor');
            // $browser->type('ticket_content', 'test content');

            // $browser->value('#contentEditor', 'value');

            // $browser->driver->switchTo()->frame('#cke_1_contents > iframe');
            // $browser->script("document.querySelector( '#cke_1_contents iframe.cke_wysiwyg_frame' );");
            // $browser->script("$('body > p').append('Appended text');");
            $browser->script("CKEDITOR.instances['contentEditor'].setData('Test Data');");
            // $browser->fillHidden('ticket_content', 'test content');
            $browser->pause(3000);
        //     $browser        ->withinFrame('iframe[name=stripe_checkout_app]', function($browser){
        //     $browser->pause(3000);
        //     $browser->keys('input[placeholder="Email"]', 'tushar@5balloons.info')
        //         ->keys('input[placeholder="Card number"]', '4242 4242 4242 4242')
        //         ->keys('input[placeholder="MM / YY"]', '0122')
        //         ->keys('input[placeholder="CVC"]', '123')
        //         ->press('button[type="submit"')
        //         ->waitUntilMissing('iframe[name=stripe_checkout_app]');
        // });

            // $browser->click('.cke_wysiwyg_frame');
            // $browser->type('.cke_wysiwyg_frame', 'test content');
            // $browser->script("'tinyMCE.get(\'description\').setContent(\'<h1>Test Description</h1>\')'");
            $browser->select('region','1');
            $browser->waitFor('.group');
            // $browser->press('Jeddah');
            // $browser->press('ITS-J');
            // $browser->click('.group');
            // $browser->select('group_id','1');
            // $browser->clickLink('test');
            // $browser->select('2', 'location_id');
            // $browser->select('4', 'category_id');
            // $browser->clickLink('ITS-J');
            $browser->select('group_id', '11');
            $browser->waitFor('#locationDiv');
            $browser->select('location_id', '16');
            $browser->waitFor('#categoryDiv');
            $browser->select('category_id', '16');
            // $browser->clickLink('test');
            // $browser->select('2', 'location_id');
            // $browser->select('4', 'category_id');
            // $browser->script("CKEDITOR.instances.contentEditor.insertHtml( '<p>This is a new paragraph.</p>' );");
            // $browser->fillHidden('ticket_content', 'test content');
            $browser->press('Create')
                    ->assertSee('Comments')
                    ->screenshot('home-page');
        });
    }
    
}
