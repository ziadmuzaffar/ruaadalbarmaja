<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $table = 'company_info';

    protected $fillable = [
        'name',
        'description',
        'about',
        'logo',
        'email',
        'phone',
        'whatsapp',
        'address',
        'city',
        'district',
        'street',
        'founded_year',
        'working_hours',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'tiktok_url',
        'is_active',
        'is_maintenance',
        'maintenance_title',
        'maintenance_message',
        'maintenance_ends_at',
        'show_hero_section',
        'show_about_section',
        'show_services_section',
        'show_statistics_section',
        'show_projects_section',
        'show_testimonials_section',
        'show_partners_section',
        'show_contact_section',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_maintenance' => 'boolean',
        'maintenance_ends_at' => 'datetime',
        'founded_year' => 'integer',
        'show_hero_section' => 'boolean',
        'show_about_section' => 'boolean',
        'show_services_section' => 'boolean',
        'show_statistics_section' => 'boolean',
        'show_projects_section' => 'boolean',
        'show_testimonials_section' => 'boolean',
        'show_partners_section' => 'boolean',
        'show_contact_section' => 'boolean',
    ];
}
