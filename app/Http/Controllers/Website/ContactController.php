<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a newly created contact message in storage.
     */
    public function store(Request $request)
    {
        // Anti-bot Honeypot check: If filled, it's an automated bot
        if ($request->filled('_hp_website')) {
            return response()->json([
                'success' => true,
                'message' => 'تم إرسال رسالتك بنجاح! سيتواصل معك فريقنا في أقرب وقت.',
            ]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:3000',
        ], [
            'name.required' => 'يرجى كتابة الاسم الكامل.',
            'email.required' => 'يرجى كتابة البريد الإلكتروني.',
            'email.email' => 'البريد الإلكتروني غير صحيح.',
            'subject.required' => 'يرجى كتابة موضوع الرسالة.',
            'message.required' => 'يرجى كتابة نص الرسالة.',
        ]);

        $contactMessage = ContactMessage::create([
            'name' => strip_tags(trim($validated['name'])),
            'email' => trim($validated['email']),
            'phone' => isset($validated['phone']) ? strip_tags(trim($validated['phone'])) : null,
            'subject' => strip_tags(trim($validated['subject'])),
            'message' => strip_tags(trim($validated['message'])),
            'status' => 'new',
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم إرسال رسالتك بنجاح! سيتواصل معك فريقنا في أقرب وقت.',
            ]);
        }

        return back()->with('success', 'تم إرسال رسالتك بنجاح! سيتواصل معك فريقنا في أقرب وقت.');
    }
}
