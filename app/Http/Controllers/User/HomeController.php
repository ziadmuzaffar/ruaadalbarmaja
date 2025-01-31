<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    private string $root = 'pages.users.';
    // Handle the incoming request.
    public function __invoke()
    {
        return view($this->root . 'home');
    }
}
