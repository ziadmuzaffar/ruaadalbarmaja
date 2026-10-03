<?php

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can submit contact message', function () {
    $response = $this->post(route('contact.store'), [
        'name' => 'زياد صالح علي مظفر',
        'email' => 'ziadmuzaffar@gmail.com',
        'phone' => '057656756',
        'subject' => 'طلب استفسار',
        'message' => 'رسالة تجريبية لاختبار إرسال النموذج',
    ]);

    $response->assertSessionHas('success');

    $this->assertDatabaseHas('contact_messages', [
        'name' => 'زياد صالح علي مظفر',
        'email' => 'ziadmuzaffar@gmail.com',
        'status' => 'new',
    ]);
});
