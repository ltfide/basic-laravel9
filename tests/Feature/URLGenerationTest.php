<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testCurrent()
    {
        $this->get('/url/current?name=lutfi')
            ->assertSeeText('http://localhost/url/current?name=lutfi');
    }

    public function testNamed()
    {
        $this->get('/redirect/named')
            ->assertStatus(200)
            ->assertSeeText('/redirect/name/lutfi');
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertStatus(200)
            ->assertSeeText('/form');
    }
}
