<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerRequest;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(Request $request): View
    {
        $query = Partner::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('website', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $partners = $query->orderBy('order', 'asc')->orderBy('id', 'desc')->paginate(9)->withQueryString();

        return view('pages.admin.partners.index', compact('partners'));
    }

    public function create(): View
    {
        return view('pages.admin.partners.create');
    }

    public function store(PartnerRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('partners', 'public');
        }

        Partner::create($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'تم إضافة الشريك بنجاح');
    }

    public function show(Partner $partner): RedirectResponse
    {
        return redirect()->route('admin.partners.edit', $partner);
    }

    public function edit(Partner $partner): View
    {
        return view('pages.admin.partners.edit', compact('partner'));
    }

    public function update(PartnerRequest $request, Partner $partner): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                Storage::disk('public')->delete($partner->image);
            }
            $data['image'] = $request->file('image')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'تم تحديث الشريك بنجاح');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        if ($partner->image && Storage::disk('public')->exists($partner->image)) {
            Storage::disk('public')->delete($partner->image);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'تم حذف الشريك بنجاح');
    }
}
