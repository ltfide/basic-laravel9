<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/loopy')
            ->assertStatus(200)
            ->assertSeeText('Lutfi Dendiansyah');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertStatus(302)
            ->assertRedirect('/loopy');
    }

    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertSeeText('404 url not found');

        $this->get('/salah')
            ->assertSeeText('404 url not found');

        $this->get('/notfound')
            ->assertSeeText('404 url not found');
    }

    public function testRouteParameter()
    {
        $this->get('/product/1')
            ->assertSeeText('Product 1');

        $this->get('/product/2')
            ->assertSeeText('Product 2');


        $this->get('/product/1/items/XXX')
            ->assertSeeText('Product 1, Item XXX');    

        $this->get('/product/2/items/YYY')
            ->assertSeeText('Product 2, Item YYY');    
    }

    public function testRouteParamaterRegex()
    {
        $this->get('/category/1')
            ->assertSeeText('Category 1');

        $this->get('/category abc')
            ->assertSeeText('404 url not found');
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/lisa')
            ->assertSeeText('User lisa');
        
        $this->get('/conflict/lutfi')
            ->assertSeeText('User Lutfi Dendiansyah');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/1')
            ->assertSeeText('Link http://localhost/product/1');

        $this->get('/produk-redirect/123')
            ->assertSeeText('http://localhost/product/123');
    }
}
