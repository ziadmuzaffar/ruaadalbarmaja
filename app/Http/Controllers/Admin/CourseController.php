<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Track;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    private string $root = 'pages.admins.courses.';
    // Display a listing of the resource.
    public function index()
    {
        return view($this->root . 'index', [
            'courses' => Course::latest('id')->get()
        ]);
    }
    // Show the form for creating a new resource.
    public function create()
    {
        return view($this->root . 'create', [
            'tracks' => Track::latest('id')->get()
        ]);
    }
    // Store a newly created resource in storage.
    public function store(CourseRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['image'] = $request->name.'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('courses/', $data['image'], 'images');
            Course::create($data);
            DB::commit();
            return back()->with('success', 'نجحت العملية');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'فشلت العملية');
        }
    }
    // Display the specified resource.
    public function show(Course $course)
    {
        return view($this->root . 'show', [
            'course' => $course
        ]);
    }
    // Show the form for editing the specified resource.
    public function edit(Course $course)
    {
        return view($this->root . 'edit', [
            'course' => $course,
            'tracks' => Track::all()
        ]);
    }

    // Update the specified resource in storage.
    public function update(CourseRequest $request, Course $course)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = date('Ymdhis').'.'.$request->file('image')->getClientOriginalExtension();
                Storage::disk('images')->delete('courses/'.$course->image);
                $request->file('image')->storeAs('courses', $data['image'],'images');
            } else {
                $data['image'] = $course->image;
            }
            $course->update($data);
            DB::commit();
            return back()->with('success', 'نجحت العملية');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'فشلت العملية');
        }
    }
    // Remove the specified resource from storage.
    public function destroy(Course $course)
    {
        DB::beginTransaction();
        try {
            if (Lesson::where('course_id', $course->id)->pluck('course_id')->count() == 0) {
                Storage::disk('images')->delete('courses/' . $course->image);
                $course->delete();
                DB::commit();
                return back()->with('success', 'نجحت العملية');
            } else {
                DB::commit();
                return back()->with('warning', 'لا يمكن حذف الدورة');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'فشلت العملية');
        }
    }
}
