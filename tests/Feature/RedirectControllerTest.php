<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    public function testRedirectTo()
    {
        $this->get('/redirect/to')
            ->assertStatus(200)
            ->assertSeeText('Hello Redirect');
    }

    public function testRedirectFrom()
    {
        $this->get('/redirect/from')
            ->assertStatus(302)
            ->assertRedirect('/redirect/to');
    }

    public function testRedirectWithNamed()
    {
        $this->get('/redirect/name')
            ->assertStatus(302)
            ->assertRedirect('/redirect/name/lutfi');
    }

    public function testRedirectAction()
    {
        $this->get('/redirect/action')
            ->assertStatus(302)
            ->assertRedirect('/redirect/name/dendiansyah');
    }

    public function testRedirectAway()
    {
        $this->get('/redirect/away')
            ->assertStatus(302)
            ->assertRedirect('https://ltfide.github.io');
    }
}
