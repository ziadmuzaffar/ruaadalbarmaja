<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::withCount('projects');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
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

        $categories = $query->orderBy('order', 'asc')->orderBy('id', 'desc')->paginate(10)->withQueryString();

        $stats = [
            'total' => Category::count(),
            'active' => Category::where('is_active', true)->count(),
            'with_projects' => Category::has('projects')->count(),
            'total_projects' => Project::count(),
        ];

        return view('pages.admin.categories.index', compact('categories', 'stats'));
    }

    public function create()
    {
        return view('pages.admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('admin.categories.index')
            ->with('success', 'تم إضافة التصنيف بنجاح');
    }

    public function show(Category $category)
    {
        $category->loadCount('projects');
        $category->load(['projects' => function ($query) {
            $query->orderBy('order', 'asc')->latest();
        }]);

        return view('pages.admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('pages.admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')
            ->with('success', 'تم تحديث التصنيف بنجاح');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'تم حذف التصنيف بنجاح');
    }
}
