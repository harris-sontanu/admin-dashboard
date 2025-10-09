<?php

namespace App\Admin\Controllers\Post;

use App\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService
        ){}
    public function index(Request $request)
    {
        $search = $request->search;
        $posts = $this->postService->listPost($search);
        return view('admin.post.index', compact(
            'posts',
            'search'
        ));
    }

    public function create()
    {
        $categories = $this->postService->getAllCategories();
        return view('admin.post.create', compact(
            'categories'
        ));
    }

    public function store(Request $request)
    {
        $validated = Validator::make(request()->all(), [
            'category'     => 'required|string|max:255',
            'title'        => 'required|string|max:255|unique:posts,title',
            'slug'         => 'required|string|max:255|unique:posts,slug',
            'body'         => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:255',
            'is_published' => 'required',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validated->fails()) {
            session()->flash('error', $validated->errors()->first());
            return redirect()->back()->withErrors($validated)->withInput();
        }
        $posts = $request->all();
        $this->postService->storePost($posts);

        session()->flash('success', 'Post Created Successfully');
        return redirect()->route('admin.post.index');
    }

    public function edit($id)
    {
        $categories = $this->postService->getAllCategories();
        $post = $this->postService->formEdit($id);
        return view('admin.post.edit', compact(
            'post',
            'categories'
        ));
    }

    public function update(Request $request, $id)
    {
        $validated = Validator::make(request()->all(), [
            'category'     => 'required|string|max:255',
            'title'        => ['required', 'string', 'max:255', Rule::unique('posts', 'title')->ignore($id)],
            'slug'         => ['required', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($id)],
            'body'         => 'required|string',
            'excerpt'      => 'nullable|string|max:255',
            'is_published' => 'required',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validated->fails()) {
            session()->flash('error', $validated->errors()->first());
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $posts = $request->all();
        $this->postService->updatePost($posts, $id);

        session()->flash('success', 'Post Updated Successfully');
        return redirect()->route('admin.post.index');
    }

    public function destroy($id)
    {
        $this->postService->destroyPost($id);
        return response()->json([
            'message' => 'Data Successfully Deleted!'
        ]);
    }

    public function show($id)
    {
        $categories = $this->postService->getAllCategories();
        $post = $this->postService->formEdit($id);
        return view('admin.post.show', compact(
            'post',
            'categories'
        ));
    }
}
