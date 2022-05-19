<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RequestTest extends TestCase
{
    public function testRequestInputExist()
    {
        $this->post('/request/input', [
            'name' => 'sally'
        ])->assertSeeText('sally');
    }

    public function testRequestInputSecondArg()
    {
        $this->post('/request/input', [])
            ->assertSeeText('lutfi');
    }

    public function testRequestBool()
    {
        $this->post('/request/bool', [
            'checkbox' => '1'
        ])->assertSeeText('1');
    }

    // public function testRequestFile()
    // {
    //     Storage::fake('avatars');

    //     $file = UploadedFile::fake()->image('avatar.jpg');

    //     $this->post('/request/file', [
    //         'gambar' => $file
    //     ])->assertSeeText('avatar.jpg');
    // }
}
