<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts'));
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
            'tags' => 'nullable|exists:tags,id'
        ];
    }
}
