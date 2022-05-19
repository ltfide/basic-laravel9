<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormControllerTest extends TestCase
{
    public function testForm()
    {
        $this->get('/form')
            ->assertStatus(200);
    }

    public function testSubmitForm()
    {
        $this->post('/form', [
                'name' => 'Lutfi'
            ])->assertStatus(200)
                ->assertSeeText('Hello Lutfi');
    }
}
