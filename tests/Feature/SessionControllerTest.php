<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreteSession()
    {
        $this->get('/session/create')
            ->assertStatus(200)
            ->assertSeeText('OK')
            ->assertSessionHas('userId', 'lutfi')
            ->assertSessionHas('isMember', 'true');
    }

    public function testGetSession()
    {
        $this->withSession([
            'userId' => 'lutfi',
            'isMember' => 'true'
        ])->get('/session/get')
            ->assertStatus(200)
            ->assertSeeText('lutfi')
            ->assertSeeText('true')
            ->assertSeeText("UserId : lutfi, isMember : true");
    }

    public function testGetSessionFailed()
    {
        $this->withSession([])
            ->get('/session/get')
            ->assertStatus(200)
            ->assertSeeText("UserId : guest, isMember : false");
    }
}
