<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request)
    {
        $name = $request->input('name');
        return "Hello $name";
    }

    public function helloFirst(Request $request) :string
    {
        $firstName = $request->input('name.first');
        return "Hello $firstName";
    }

    public function helloInputAll(Request $request) :string
    {
        $input = $request->input();
        return response()
            ->json($input);
    }

    public function helloArray(Request $request) :string
    {
        $names = $request->input('products.*name');
        return response()
            ->json($names);
    }

    public function helloQuery(Request $request) :string
    {
        $input = $request->query('name');
        return "Hello $input";
    }

    public function inputType(Request $request) :string
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birthDate = $request->date('birth_date', 'Y-m-d');

        return json_encode([
            'name' => $name,
            'married' => $married,
            'birth_date' => $birthDate->format('Y-m-d')
        ]);
    }

    public function filterOnly(Request $request) :string
    {
        $input = $request->only('name.first', 'name.last');
        return response()
            ->json($input);
    }

    public function filterExcept(Request $request) :string
    {
        $input = $request->except('admin');
        return response()
            ->json($input);
    }

    public function filterMerge(Request $request) :string
    {
        $request->merge(['admin' => false]);
        $input = $request->input();
        return response()
            ->json($input);
    }
}
