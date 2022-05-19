<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('lutfi');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name'=> 'Lutfi', 'age' => 24])
            ->assertSeeText('Lutfi');
    }
}
