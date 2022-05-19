<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');
        $email = config('contoh.email');
        $web = config('contoh.web');

        $this->assertEquals('Lutfi', $firstName);
        $this->assertEquals('Dendiansyah', $lastName);
        $this->assertEquals('lutfi@example.id', $email);
        $this->assertEquals('lutfi.github.io', $web);
    }
}
