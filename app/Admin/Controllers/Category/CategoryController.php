<?php

namespace App\Admin\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService,)
    {

    }
    public function index(Request $request)
    {
        $search = $request->search;
        $categories = $this->categoryService->listCategories($search);
        return view('admin.category.index', compact(
            'categories',
            'search'
        ));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validated = Validator::make(request()->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'required|string|max:255|unique:categories,slug',
        ]);

        if ($validated->fails()) {
            session()->flash('error', $validated->errors()->first());
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $categories = $request->all();
        $this->categoryService->storeCategory($categories);

        session()->flash('success', 'Category Created Successfully');
        return redirect()->route('admin.category.index');
    }

    public function edit($id)
    {
        $category = $this->categoryService->formEdit($id);
        return view('admin.category.edit', compact(
            'category'
        ));
    }

    public function update(Request $request, $id)
    {
        $validated = Validator::make(request()->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'required|string|max:255|unique:categories,slug',
        ]);

        
        if ($validated->fails()) {
            session()->flash('error', $validated->errors()->first());
            return redirect()->back()->withErrors($validated)->withInput();
        }
        $categories = $request->all();
        $this->categoryService->updateCategory($categories, $id);

        session()->flash('success', 'Category Updated Successfully');
        return redirect()->route('admin.category.index');
    }

    public function destroy($id)
    {
        $this->categoryService->destroyCategory($id);
        return response()->json([
            'message' => 'Data Successfully Deleted!'
        ]);
    }
}
