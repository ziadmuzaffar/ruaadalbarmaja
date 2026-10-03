<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactMessageRequest;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(10);

        return view('pages.admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        // Mark as read if not already
        if ($contactMessage->status === 'new') {
            $contactMessage->update([
                'status' => 'read',
                'read_at' => now(),
            ]);
        }

        return view('pages.admin.contact-messages.show', compact('contactMessage'));
    }

    public function update(ContactMessageRequest $request, ContactMessage $contactMessage)
    {
        // Only allow updating status and admin_notes
        $data = $request->only(['status', 'admin_notes']);

        // Update replied_at timestamp if status changed to replied
        if ($data['status'] === 'replied' && $contactMessage->status !== 'replied') {
            $data['replied_at'] = now();
        }

        $contactMessage->update($data);

        return redirect()->route('admin.contact-messages.show', $contactMessage)
            ->with('success', 'تم تحديث حالة الرسالة بنجاح');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'تم حذف الرسالة بنجاح');
    }

    public function markAllAsRead()
    {
        ContactMessage::where('status', 'new')->update([
            'status' => 'read',
            'read_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تم تحديد جميع الرسائل والتنبيهات كمقروءة بنجاح');
    }
}
