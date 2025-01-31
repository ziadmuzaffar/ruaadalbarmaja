<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lesson;

class LessonController extends Controller
{
    private string $root = 'pages.users.lessons.';
    // Display the specified resource.
    public function show(int $id)
    {
        return view($this->root . 'show', [
            'lesson' => Lesson::where('id', $id)->first(),
        ]);
    }
}
