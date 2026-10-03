<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StatisticRequest;
use App\Models\Statistic;

use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $query = Statistic::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('label', 'like', "%{$search}%")
                    ->orWhere('value', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        if ($request->filled('type')) {
            if (in_array($request->type, ['manual', 'auto'])) {
                $query->where('type', $request->type);
            }
        }

        $statistics = $query->orderBy('order', 'asc')->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('pages.admin.statistics.index', compact('statistics'));
    }

    public function create()
    {
        return view('pages.admin.statistics.create');
    }

    public function store(StatisticRequest $request)
    {
        Statistic::create($request->validated());

        return redirect()->route('admin.statistics.index')
            ->with('success', 'تم إضافة الإحصائية بنجاح');
    }

    public function edit(Statistic $statistic)
    {
        return view('pages.admin.statistics.edit', compact('statistic'));
    }

    public function update(StatisticRequest $request, Statistic $statistic)
    {
        $statistic->update($request->validated());

        return redirect()->route('admin.statistics.index')
            ->with('success', 'تم تحديث الإحصائية بنجاح');
    }

    public function destroy(Statistic $statistic)
    {
        $statistic->delete();

        return redirect()->route('admin.statistics.index')
            ->with('success', 'تم حذف الإحصائية بنجاح');
    }
}
