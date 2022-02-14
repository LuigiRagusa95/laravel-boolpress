<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $tags = Tag::all();
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts', 'tags'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());
        $data = $request->all();

        if (array_key_exists('cover', $data)) {
            $data['cover'] = Storage::put('uploads/', $data['cover']);
        }

        $post = new Post();

        $slug_retrived = Str::slug($data['title'], '-');
        $slug_base = $slug_retrived;
        $slug_counter = 1;

        while (Post::where('slug', $slug_retrived)->first()) {
            $slug_retrived = $slug_base . '-' . $slug_counter;
            $slug_counter++;
        }

        $data['slug'] = $slug_retrived;
        $post->fill($data);
        $post->save();

        if (array_key_exists('tags', $data)) {
            $post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $post->id);
    }

    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) abort(404);

        return view('admin.posts.show', compact('post'));
    }

    public function edit($id)
    {
        $tags = Tag::all();
        $post = Post::find($id);
        $categories = Category::all();
        if (!$post) abort(404);

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->rules());

        $data = $request->all();
        $post = Post::find($id);

        if (array_key_exists('cover', $data)) {
            if ($post->cover) {
                Storage::delete($post->cover);
            }
            $data['cover'] = Storage::put('uploads', $data['cover']);
        }

        if ($data['title'] != $post->title) {
            $slug_retrived = Str::slug($data['title'], '-');
            $slug_base = $slug_retrived;
            $slug_counter = 1;

            while (Post::where('slug', $slug_retrived)->first()) {
                $slug_retrived = $slug_base . '-' . $slug_counter;
                $slug_counter++;
            }

            $data['slug'] = $slug_retrived;
        } else {
            $data['slug'] = $post->slug;
        }

        $post->update($data);

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post->id);
    }

    public function destroy($id)
    {
        //
    }

    private function rules()
    {
        return [
            'title' => 'required|max:100',
            'text' => 'required',
            'category_id' => 'nullable',
            'tags' => 'nullable|exists:tags,id',
            'cover' => 'nullable|file|mimes:png,jpeg'
        ];
    }
}
