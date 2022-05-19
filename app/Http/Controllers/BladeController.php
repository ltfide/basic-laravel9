<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BladeController extends Controller
{
    public function ifStatements()
    {
        return response()
            ->view('blade_template.if_statement', ['name' => 'lutfi']);
    }

    public function switchStatements()
    {
        return response()
            ->view('blade_template.switch_statement', ['i' => 2]);
    }

    public function loops()
    {
        return response()
            ->view('blade_template.loops', [
                'users' => [
                    [
                        'name' => 'lutfi',
                        'age' => 24
                    ],
                    [
                        'name' => 'lisa',
                        'age' => 20
                    ]
                ]
            ]);
    }

    public function classes()
    {
        return response()
            ->view('blade_template.conditional_classes');
    }
}
