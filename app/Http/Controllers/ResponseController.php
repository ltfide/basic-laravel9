<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function hello() 
    {
        return response('Hello Response');
    }

    public function header(Request $request) : Response
    {
        $body = ['firstName' => 'Lutfi', 'lastName' => 'Dendiansyah'];
        return response(json_encode($body), 200)
            ->header('Content-type', 'application/json')
            ->withHeaders([
                'Author' => 'Lutfi',
                'App' => 'Belajar Laravel'
            ]);
    }

    public function view()
    {
        return response()
            ->view('hello', ['name' => 'Lutfi']);
    }

    public function json()
    {
        return response()
            ->json([
                'firstName' => 'Lutfi',
                'lastName' => 'Dendiansyah'
            ], 200);
    }

    public function file(Request $request) :BinaryFileResponse
    {
        return response()
            ->file(storage_path('app/public/pictures/lutfi.jpg'));
    }

    public function download(Request $request) :BinaryFileResponse
    {
        return response()
            ->download(storage_path('app/public/pictures/lutfi.jpg', 'lutfi.jpg'));
    }
}
