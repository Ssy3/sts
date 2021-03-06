<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Carbon\Carbon;


class AgentInOtherGroupsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAgentCanLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login');
            $browser->clickLink('Admin');
            $browser->type('email', env('TEST_AGENT_ROLE_USER'));
            $browser->type('password', env('TEST_AGENT_ROLE_PASSWORD'));
            $browser->press('LOGIN');
            $browser->assertPathIs('/');
        });
    }

    public function testAgentRequestTicket()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ticket');
            $browser->visit('/ticket/create');
            $browser->type('ticket_title', 'test ticket ' . Carbon::now()->toDateTimeString());
            $browser->script("CKEDITOR.instances['contentEditor'].setData('Test Data');");
            $browser->pause(3000);
            $browser->select('region','1');
            $browser->waitFor('.group');
            $browser->select('group_id','5');
            $browser->waitFor('#location_id');
            $browser->select('location_id','9');
            $browser->waitFor('#categoryDiv');
            $browser->select('category_id','10');
            $browser->type('room_number','324');
            $browser->press('Create')
                    ->assertSee('Comments');
                    // ->screenshot('home-page');
        });
    }
    public function testSupervisorAddCommentToRequestedTicket()
    {
        $this->browse(function (Browser $browser) {
            $this->browse(function ($browser) {
                $browser->script("CKEDITOR.instances['editor'].setData('Test Comment');");
                $browser->press('Add Comment')
                ->assertSee('Test Comment');
            });
        });
    }
}
