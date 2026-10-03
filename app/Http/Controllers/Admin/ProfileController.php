<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('pages.admin.profile.show', [
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('pages.admin.profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Update password if provided
        if ($request->filled('password')) {
            if ($request->filled('current_password') && !Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة'])->withInput();
            }
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.profile.show')
            ->with('success', 'تم تحديث إعدادات الحساب بنجاح');
    }
}
