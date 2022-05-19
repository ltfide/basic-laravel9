<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertStatus(200)
            ->assertCookie('User-Id', 'lutfi')
            ->assertCookie('Is-Member', 'true');
    }

    public function testGetCookie()
    {
        $this->withCookie('User-Id', 'lutfi')
            ->withCookie('Is-Member', 'true')
            ->get('/cookie/get')
            ->assertStatus(200)
            ->assertJson([
                'userId' => 'lutfi',
                'isMember' => 'true'
            ]);
    }

    public function testClearCookie()
    {
        $this->get('/cookie/clear')
            ->assertStatus(200)
            ->assertSeeText('Clear Cookie')
            ->withoutCookie('User-Id')
            ->withoutCookie('Is-Member');
    }
}
