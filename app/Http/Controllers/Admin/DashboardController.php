<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    private string $root = 'pages.admins.';
    // Display a listing of the resource.
    public function index()
    {
        return view($this->root . 'dashboard');
    }
}
