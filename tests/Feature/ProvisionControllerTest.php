<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProvisionControllerTest extends TestCase
{
    public function testProvisionPost()
    {
        $this->post('/server', [
            'name' => 'lutfi'
        ])->assertStatus(200)
            ->assertSeeText('lutfi');
    }
}
