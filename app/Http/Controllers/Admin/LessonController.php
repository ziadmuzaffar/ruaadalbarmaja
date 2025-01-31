<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    private string $root = 'pages.admins.lessons.';
    // Display a listing of the resource.
    public function index()
    {
        return view($this->root . 'index', [
            'lessons' => Lesson::all()
        ]);
    }
    // Show the form for creating a new resource.
    public function create()
    {
        return view($this->root . 'create', [
            'courses' => Course::all()
        ]);
    }
    // Store a newly created resource in storage.
    public function store(LessonRequest $request)
    {
        DB::beginTransaction();
        try {
            Lesson::create($request->all());
            DB::commit();
            return back()->with('success', 'نجحت العملية');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'فشلت العملية');
        }
    }
    // Display the specified resource.
    public function show(int $id)
    {
    }
    // Show the form for editing the specified resource.
    public function edit(Lesson $lesson)
    {
        return view($this->root . 'edit', [
            'lesson' => $lesson,
            'courses' => Course::all()
        ]);
    }
    // Update the specified resource in storage.
    public function update(Request $request, Lesson $lesson)
    {
        DB::beginTransaction();
        try {
            $lesson->update($request->all());
            DB::commit();
            return back()->with('success', 'نجحت العملية');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'فشلت العملية');
        }
    }
    // Remove the specified resource from storage.
    public function destroy(Lesson $lesson)
    {
        DB::beginTransaction();
        try {
            $lesson->delete();
            DB::commit();
            return back()->with('success', 'نجحت العملية');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'فشلت العملية');
        }
    }
}
