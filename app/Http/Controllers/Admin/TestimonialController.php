<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(Request $request): View
    {
        $query = Testimonial::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                    ->orWhere('client_position', 'like', "%{$search}%")
                    ->orWhere('client_company', 'like', "%{$search}%")
                    ->orWhere('testimonial', 'like', "%{$search}%");
            });
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->input('rating'));
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $testimonials = $query->orderBy('order', 'asc')->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('pages.admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('pages.admin.testimonials.create');
    }

    public function store(TestimonialRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('client_image')) {
            $data['client_image'] = $request->file('client_image')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'تم إضافة الشهادة بنجاح');
    }


    public function edit(Testimonial $testimonial): View
    {
        return view('pages.admin.testimonials.edit', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('client_image')) {
            if ($testimonial->client_image && Storage::disk('public')->exists($testimonial->client_image)) {
                Storage::disk('public')->delete($testimonial->client_image);
            }
            $data['client_image'] = $request->file('client_image')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'تم تحديث الشهادة بنجاح');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        if ($testimonial->client_image && Storage::disk('public')->exists($testimonial->client_image)) {
            Storage::disk('public')->delete($testimonial->client_image);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'تم حذف الشهادة بنجاح');
    }
}
