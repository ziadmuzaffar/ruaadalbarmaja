<?php

use App\Models\CompanyInfo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('can view company info index page', function () {
    $companyInfo = CompanyInfo::factory()->create();

    $response = $this->get(route('admin.company-info.index'));

    $response->assertRedirect(route('admin.company-info.show'));
});

test('can view company info edit page', function () {
    $companyInfo = CompanyInfo::factory()->create();

    $response = $this->get(route('admin.company-info.edit'));

    $response->assertStatus(200);
    $response->assertSee($companyInfo->name);
});

test('can update company info', function () {
    $companyInfo = CompanyInfo::factory()->create();

    $data = [
        'name' => 'Updated Company Name',
        'description' => 'Updated description',
        'about' => 'Updated about section',
        'email' => 'updated@example.com',
        'phone' => '+966 11 111 1111',
        'whatsapp' => '+966 50 111 1111',
        'address' => 'Updated Address',
        'city' => 'جدة',
        'district' => 'الحمراء',
        'street' => 'Updated Street',
        'founded_year' => 2020,
        'working_hours' => 'من السبت إلى الخميس: 9 ص - 6 م',
        'facebook_url' => 'https://facebook.com/updated',
        'twitter_url' => 'https://twitter.com/updated',
        'linkedin_url' => 'https://linkedin.com/company/updated',
        'instagram_url' => 'https://instagram.com/updated',
        'tiktok_url' => 'https://tiktok.com/@updated',
        'is_active' => true,
    ];

    $response = $this->put(route('admin.company-info.update'), $data);

    $response->assertRedirect(route('admin.company-info.show'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('company_info', [
        'name' => 'Updated Company Name',
        'email' => 'updated@example.com',
        'city' => 'جدة',
        'working_hours' => 'من السبت إلى الخميس: 9 ص - 6 م',
        'tiktok_url' => 'https://tiktok.com/@updated',
    ]);
});

test('can update company info with logo', function () {
    Storage::fake('public');

    $companyInfo = CompanyInfo::factory()->create();

    $data = [
        'name' => 'Company with Logo',
        'description' => 'Description',
        'about' => 'About section',
        'logo' => UploadedFile::fake()->create('logo.jpg', 100, 'image/jpeg'),
        'email' => 'test@example.com',
        'phone' => '+966 11 111 1111',
        'address' => 'Address',
        'city' => 'الرياض',
        'district' => 'السلي',
        'founded_year' => 2020,
        'is_active' => true,
    ];

    $response = $this->put(route('admin.company-info.update'), $data);

    $response->assertRedirect(route('admin.company-info.show'));

    $companyInfo->refresh();
    expect($companyInfo->logo)->not->toBeNull();
    Storage::disk('public')->assertExists($companyInfo->logo);
});

test('validates required fields', function () {
    CompanyInfo::factory()->create();

    $response = $this->put(route('admin.company-info.update'), []);

    $response->assertSessionHasErrors([
        'name',
        'description',
        'about',
        'email',
        'phone',
        'address',
        'city',
        'district',
    ]);
});

test('validates email format', function () {
    CompanyInfo::factory()->create();

    $data = [
        'name' => 'Test Company',
        'description' => 'Description',
        'about' => 'About',
        'email' => 'invalid-email',
        'phone' => '+966 11 111 1111',
        'address' => 'Address',
        'city' => 'الرياض',
        'district' => 'السلي',
        'founded_year' => 2020,
    ];

    $response = $this->put(route('admin.company-info.update'), $data);

    $response->assertSessionHasErrors('email');
});

test('validates url format for social media', function () {
    CompanyInfo::factory()->create();

    $data = [
        'name' => 'Test Company',
        'description' => 'Description',
        'about' => 'About',
        'email' => 'test@example.com',
        'phone' => '+966 11 111 1111',
        'address' => 'Address',
        'city' => 'الرياض',
        'district' => 'السلي',
        'founded_year' => 2020,
        'facebook_url' => 'not-a-url',
        'tiktok_url' => 'not-a-url',
    ];

    $response = $this->put(route('admin.company-info.update'), $data);

    $response->assertSessionHasErrors(['facebook_url', 'tiktok_url']);
});

test('creates company info if not exists', function () {
    expect(CompanyInfo::count())->toBe(0);

    $response = $this->get(route('admin.company-info.edit'));

    $response->assertStatus(200);
    expect(CompanyInfo::count())->toBe(1);
});

test('allows updating company info with empty social media links', function () {
    $companyInfo = CompanyInfo::factory()->create();

    $data = [
        'name' => 'Company Without Social Links',
        'description' => 'Description',
        'about' => 'About section',
        'email' => 'test@example.com',
        'phone' => '+966 11 111 1111',
        'address' => 'Address',
        'city' => 'الرياض',
        'district' => 'السلي',
        'founded_year' => 2020,
        'facebook_url' => null,
        'twitter_url' => null,
        'linkedin_url' => null,
        'instagram_url' => null,
        'tiktok_url' => null,
        'is_active' => true,
    ];

    $response = $this->put(route('admin.company-info.update'), $data);

    $response->assertRedirect(route('admin.company-info.show'));
    $this->assertDatabaseHas('company_info', [
        'name' => 'Company Without Social Links',
        'facebook_url' => null,
        'twitter_url' => null,
        'linkedin_url' => null,
        'instagram_url' => null,
        'tiktok_url' => null,
    ]);
});

