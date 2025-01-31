<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrackRequest;
use App\Models\Course;
use App\Models\Track;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TrackController extends Controller
{
    private string $root = 'pages.admins.tracks.';
    // Display a listing of the resource.
    public function index()
    {
        return view($this->root . 'index', [
            'tracks' => Track::all()
        ]);
    }
    // Show the form for creating a new resource.
    public function create()
    {
        return view($this->root . 'create');
    }
    // Store a newly created resource in storage.
    public function store(TrackRequest $request)
    {
        DB::beginTransaction();
        try {
            Track::create($request->all());
            DB::commit();
            return back()->with('success', 'نجحت العملية');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'فشلت العملية');
        }
    }
    // Display the specified resource.
    public function show(Track $track)
    {
    }
    // Show the form for editing the specified resource.
    public function edit(Track $track)
    {
        return view($this->root . 'edit', [
            'track' => $track
        ]);
    }
    // Update the specified resource in storage.
    public function update(TrackRequest $request, Track $track)
    {
        DB::beginTransaction();
        try {
            $track->update($request->all());
            DB::commit();
            return back()->with('success', 'نجحت العملية');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'فشلت العملية');
        }
    }
    // Remove the specified resource from storage.
    public function destroy(Track $track)
    {
        DB::beginTransaction();
        try {
            $track->delete();
            DB::commit();
            return back()->with('success', 'نجحت العملية');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'فشلت العملية');
        }
    }
}
