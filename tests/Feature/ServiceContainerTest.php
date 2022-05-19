<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        $foo1 = $this->app->make(Foo::class); 
        $foo2 = $this->app->make(Foo::class); 

        $this->assertEquals('Foo', $foo1->foo());
        $this->assertEquals('Foo', $foo2->foo());
        // $this->assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person('Lutfi', 'Dendiansyah');
        });

        $person1 = $this->app->make(Person::class); // closure() // new Person('Lutfi', 'Dendiansyah')
        $person2 = $this->app->make(Person::class); // closure() // new Person('Lutfi', 'Dendiansyah')

        $this->assertEquals('Lutfi', $person1->firstName);
        $this->assertEquals('Lutfi', $person1->firstName);
        $this->assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person('Lutfi', 'Dendiansyah');
        });

        $person1 = $this->app->make(Person::class); // new Person('Lutfi', 'Dendiansyah') if not exists
        $person2 = $this->app->make(Person::class); // return existing

        $this->assertEquals('Lutfi', $person1->firstName);
        $this->assertEquals('Lutfi', $person1->firstName);
        $this->assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person('Lutfi', 'Dendiansyah');
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person

        $this->assertEquals('Lutfi', $person1->firstName);
        $this->assertEquals('Lutfi', $person1->firstName);
        $this->assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        $this->assertSame($foo, $bar1->foo);
        $this->assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        // versi closure()
        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        $this->assertEquals('Hello Lutfi', $helloService->hello('Lutfi'));
    }
}
