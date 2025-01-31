<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Track;

class TrackController extends Controller
{
    private string $root = 'pages.users.tracks.';
    // Display a listing of the resource.
    public function index()
    {
        return view($this->root . 'index', [
            'tracks' => Track::latest('id')->get()
        ]);
    }
    // Display the specified resource.
    public function show(int $id)
    {
        return view($this->root . 'show', [
            'track' => Track::where('id', $id)->first(),
        ]);
    }
}
