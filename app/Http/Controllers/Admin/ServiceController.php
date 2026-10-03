<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $services = $query->orderBy('order', 'asc')->orderBy('id', 'desc')->paginate(10)->withQueryString();

        $stats = [
            'total' => Service::count(),
            'active' => Service::where('is_active', true)->count(),
            'inactive' => Service::where('is_active', false)->count(),
        ];

        return view('pages.admin.services.index', compact('services', 'stats'));
    }

    public function create()
    {
        return view('pages.admin.services.create');
    }

    public function store(ServiceRequest $request)
    {
        Service::create($request->validated());

        return redirect()->route('admin.services.index')
            ->with('success', 'تم إضافة الخدمة بنجاح');
    }

    public function show(Service $service): RedirectResponse
    {
        return redirect()->route('admin.services.edit', $service);
    }

    public function edit(Service $service)
    {
        return view('pages.admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());

        return redirect()->route('admin.services.index')
            ->with('success', 'تم تحديث الخدمة بنجاح');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'تم حذف الخدمة بنجاح');
    }
}
