<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $root = 'pages.admins.users.';
    // Display a listing of the resource.
    public function index()
    {
        return view($this->root . 'index', [
            'users' => User::all()
        ]);
    }
    // Show the form for creating a new resource.
    public function create()
    {
        return view($this->root . 'create');
    }
    // Store a newly created resource in storage.
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            User::create($request->all());
            DB::commit();
            return back()->with('success', 'نجحت العملية');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'فشلت العملية');
        }
    }
    // Display the specified resource.
    public function show(User $user)
    {
    }
    // Show the form for editing the specified resource.
    public function edit(User $user)
    {
        return view($this->root . 'edit', [
            'user' => $user
        ]);
    }
    // Update the specified resource in storage.
    public function update(UserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = date('Ymdhis') . '.' . $request->file('image')->getClientOriginalExtension();
                Storage::disk('images')->delete('users/'.$user->image);
                $request->file('image')->storeAs('users', $data['image'],'images');
            } else {
                $data['image'] = $user->image;
            }
            if ($data['password']) {
                $data['password'] = Hash::make($request->password);
            } else {
                $data['password'] = $user->password;
            }
            User::findorfail($request->id)->update($data);
            DB::commit();
            return back()->with('success', 'نجحت العملية');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'فشلت العملية');
        }
    }
    // Remove the specified resource from storage.
    public function destroy(User $user)
    {
        return back()->with('warning', 'لا يمكن حذف المستخدم');
    }
}
