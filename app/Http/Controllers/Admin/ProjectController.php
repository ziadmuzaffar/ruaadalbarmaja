<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('category');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        if ($request->filled('featured')) {
            if ($request->featured === '1' || $request->featured === 'true') {
                $query->where('is_featured', true);
            } elseif ($request->featured === '0' || $request->featured === 'false') {
                $query->where('is_featured', false);
            }
        }

        $projects = $query->orderBy('order', 'asc')->orderBy('id', 'desc')->paginate(10)->withQueryString();
        $categories = Category::orderBy('order', 'asc')->get();

        return view('pages.admin.projects.index', compact('projects', 'categories'));
    }

    public function create(Request $request)
    {
        $categories = Category::where('is_active', true)->orderBy('order', 'asc')->get();
        $selectedCategory = $request->input('category_id');

        return view('pages.admin.projects.create', compact('categories', 'selectedCategory'));
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'تم إضافة المشروع بنجاح');
    }

    public function show(Project $project)
    {
        $project->load('category');

        return view('pages.admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $categories = Category::orderBy('order', 'asc')->get();

        return view('pages.admin.projects.edit', compact('project', 'categories'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'تم تحديث المشروع بنجاح');
    }

    public function destroy(Project $project)
    {
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'تم حذف المشروع بنجاح');
    }
}
