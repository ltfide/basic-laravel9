<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=lutfi')
            ->assertStatus(200)
            ->assertSeeText('Hello lutfi');

        $this->post('/input/hello', [
            'name' => 'lutfi'
        ])->assertStatus(200)
            ->assertSeeText('Hello lutfi');
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'Lutfi',
                'last' => 'Dendiansyah'
            ]
        ])->assertStatus(200)
            ->assertSeeText('Hello Lutfi');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Lutfi',
                'last' => 'Dendiansyah'
            ]
        ])->assertStatus(200)
          ->assertSeeText('name')
          ->assertSeeText('first')
          ->assertSeeText('last')
          ->assertSeeText('Lutfi')
          ->assertSeeText('Dendiansyah');
    }

    public function testInputArray()
    {
        $this->post('/input/hello/input', [
            'products' => [
                [
                    'name' => 'Laptop Asus',
                    'price' => 10000000
                ],
                [
                    'name' => 'Samsung S7',
                    'price' => 4000000
                ]
            ]
        ])->assertStatus(200)
            ->assertSeeText('Laptop Asus')
            ->assertSeeText('Samsung S7');

    }

    public function testQuery()
    {
        $this->get('/input/hello/query?name=Lutfi')
            ->assertSeeText('Hello Lutfi');
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Lutfi',
            'married' => 'true',
            'birth_date' => '1990-10-10'
        ])->assertStatus(200)
            ->assertSeeText('Lutfi')
            ->assertSeeText('true')
            ->assertSeeText('1990-10-10');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name' => [
                'first' => 'Lutfi',
                'middle' => 'not yet',
                'last' => 'Dendiansyah'
            ]
        ])->assertStatus(200)
            ->assertSeeText('Lutfi')
            ->assertSeeText('Dendiansyah')
            ->assertDontSeeText('not yet');
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            'name' => 'Lutfi',
            'password' => '12345',
            'admin' => 'true'
        ])->assertStatus(200)
            ->assertSeeText('Lutfi')
            ->assertSeeText('12345')
            ->assertDontSeeText('admin');
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            'name' => 'Lutfi',
            'password' => '123',
            'admin' => 'true'
        ])->assertStatus(200)
            ->assertSeeText('Lutfi')
            ->assertSeeText('123')
            ->assertSeeText('admin')
            ->assertSeeText('false');
    }
}
