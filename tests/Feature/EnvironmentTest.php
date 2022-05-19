<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class EnvironmentTest extends TestCase
{
    public function testEnv()
    {
        $appName = env('Youtube');

        $this->assertEquals('Lutfi Channel', $appName);
    }

    public function testDefaultValue()
    {
        // $appName = env('Author', 'Lutfi');
        $appName = Env::get('Author', 'Lutfi');

        $this->assertEquals('Lutfi', $appName);
    }
}
