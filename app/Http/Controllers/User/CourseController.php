<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;

class CourseController extends Controller
{
    private string $root = 'pages.users.courses.';
    // Display a listing of the resource.
    public function index()
    {
        return view($this->root . 'index', [
            'courses' => Course::latest('id')->get()
        ]);
    }
    // Display the specified resource.
    public function show(int $id)
    {
        return view($this->root . 'show', [
            'course' => Course::where('id', $id)->first(),
        ]);
    }
}
