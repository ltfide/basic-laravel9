<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText('Hello Response');
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('Lutfi')
            ->assertSeeText('Dendiansyah')
            ->assertHeader('Content-type', 'application/json')
            ->assertHeader('Author', 'Lutfi')
            ->assertHeader('App', 'Belajar Laravel');
    }

    public function testView()
    {
        $this->get('/response/view')
            ->assertSeeText('Lutfi');
    }

    public function testJson()
    {
        $this->get('/response/json')
            ->assertJson([
                'firstName' => 'Lutfi',
                'lastName' => 'Dendiansyah'
            ]);
    }

    public function testFile()
    {
        $this->get('/response/file')
            ->assertHeader('Content-Type', 'image/jpeg');
    }

    public function testDownload()
    {
        $this->get('/response/download')
            ->assertDownload('lutfi.jpg');
    }
}
