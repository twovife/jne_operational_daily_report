<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $navbar = [
            'home' => '/',
            'dashboard' => '/dashboard'
        ];
        return view('dashboard', [
            'navbar' => $navbar
        ]);
    }
}
