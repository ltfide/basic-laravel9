<?php

namespace Tests\Feature;


use App\Data\Bar;
use App\Data\Foo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DependencyInjectionTest extends TestCase
{
    public function testDependencyInjection()
    {
        $foo = new Foo();
        $bar = new Bar($foo);

        $this->assertEquals('Foo and Bar', $bar->bar());
    }
}