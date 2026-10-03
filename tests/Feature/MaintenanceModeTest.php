<?php

use App\Models\CompanyInfo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('public home page returns 200 when maintenance mode is off', function () {
    CompanyInfo::factory()->create([
        'is_active' => true,
        'is_maintenance' => false,
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
});

test('public home page returns 503 and maintenance view when maintenance mode is on', function () {
    $company = CompanyInfo::factory()->create([
        'name' => 'رواد البرمجة للتجربة',
        'is_active' => true,
        'is_maintenance' => true,
        'maintenance_title' => 'الموقع يخضع لأعمال الصيانة والتطوير',
        'maintenance_message' => 'نعمل على تقديم تجربة جديدة ومميزة، سنعود قريباً!',
    ]);

    $response = $this->get('/');

    $response->assertStatus(503);
    $response->assertSee('الموقع يخضع لأعمال الصيانة والتطوير');
    $response->assertSee('نعمل على تقديم تجربة جديدة ومميزة، سنعود قريباً!');
    $response->assertSee('رواد البرمجة للتجربة');
});

test('json requests receive 503 json payload during maintenance mode', function () {
    CompanyInfo::factory()->create([
        'is_maintenance' => true,
        'maintenance_title' => 'صيانة مؤقتة للأنظمة',
    ]);

    $response = $this->getJson('/');

    $response->assertStatus(503);
    $response->assertJson([
        'message' => 'صيانة مؤقتة للأنظمة',
    ]);
});

test('admin login and admin routes are NOT blocked during maintenance mode', function () {
    CompanyInfo::factory()->create([
        'is_maintenance' => true,
    ]);

    $response = $this->get('/admin/login');

    $response->assertStatus(200);
});

test('authenticated admin can access public home page during maintenance mode', function () {
    $user = User::factory()->create();
    CompanyInfo::factory()->create([
        'is_active' => true,
        'is_maintenance' => true,
    ]);

    $response = $this->actingAs($user)->get('/');

    $response->assertStatus(200);
});

test('anyone can view the maintenance preview page', function () {
    $company = CompanyInfo::factory()->create([
        'is_maintenance' => false,
        'maintenance_title' => 'معاينة وضع الصيانة التفاعلية',
    ]);

    $response = $this->get(route('maintenance.preview'));

    $response->assertStatus(200);
    $response->assertSee('معاينة وضع الصيانة التفاعلية');
});

test('admin can toggle maintenance mode via route', function () {
    $user = User::factory()->create();
    $company = CompanyInfo::factory()->create([
        'is_maintenance' => false,
    ]);

    $response = $this->actingAs($user)->post(route('admin.company-info.toggle-maintenance'));

    $response->assertRedirect();
    $company->refresh();
    expect($company->is_maintenance)->toBeTrue();

    // Toggle back off
    $response2 = $this->actingAs($user)->post(route('admin.company-info.toggle-maintenance'));
    $response2->assertRedirect();
    $company->refresh();
    expect($company->is_maintenance)->toBeFalse();
});

test('admin can update maintenance settings with title message and countdown', function () {
    $user = User::factory()->create();
    $company = CompanyInfo::factory()->create([
        'is_maintenance' => false,
    ]);

    $data = [
        'name' => $company->name,
        'description' => $company->description,
        'about' => $company->about,
        'email' => $company->email,
        'phone' => $company->phone,
        'whatsapp' => $company->whatsapp,
        'address' => $company->address,
        'city' => $company->city,
        'district' => $company->district,
        'founded_year' => $company->founded_year,
        'is_active' => true,
        'is_maintenance' => true,
        'maintenance_title' => 'عنوان مخصص للصيانة',
        'maintenance_message' => 'رسالة مخصصة لاختبار الإعدادات',
        'maintenance_ends_at' => now()->addDays(2)->format('Y-m-d\TH:i'),
    ];

    $response = $this->actingAs($user)->put(route('admin.company-info.update'), $data);

    $response->assertRedirect(route('admin.company-info.show'));
    $company->refresh();
    expect($company->is_maintenance)->toBeTrue();
    expect($company->maintenance_title)->toBe('عنوان مخصص للصيانة');
    expect($company->maintenance_message)->toBe('رسالة مخصصة لاختبار الإعدادات');
    expect($company->maintenance_ends_at)->not->toBeNull();
});
