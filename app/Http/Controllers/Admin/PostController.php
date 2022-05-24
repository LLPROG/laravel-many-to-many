<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Category;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class PostController extends Controller
{

    // validation with function
    private function validator($model) {
        return [

            'category_id'   => 'required|exists:App\Category,id',
            'title'         => 'required|min:3|max:100',
            'content'       => 'required',
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($model),
            ],
            'tags'          => 'exists:App\tag,id'
        ];
    }

    // function to shwo just personal id post
    public function myindex(Request $request) {

        $posts = Post::where('user_id', Auth::user()->id)
            ->where('id', '>', 0);
        $categories = Category::all();

        if ($request->category) {
            $posts->where('category_id', $request->category);
        }

        $posts = $posts->paginate(20);

        return view('admin.posts.index', [
            'posts' => $posts,
            'categories'  => $categories,
            'request' => $request
        ]);
    }

    public function index(Request $request) {

        $posts = Post::where('id', '>', 0);

        if ($request->category) {
            $posts->where('category_id', $request->category);
        }

        $posts = $posts->paginate(20);

        $categories = Category::all();

        return view('admin.posts.index', [
            'posts' => $posts,
            'categories'  => $categories,
            'request' => $request
        ]);
    }

    public function create() {
        $categories = Category::all();
        $tags = Tag::all();
        // dd($categories);
        return view('admin.posts.create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function store(Request $request) {

        //validazione
        $request->validate($this->validator(null));

        $formData = $request->all() + [
            'user_id' => Auth::user()->id
        ];

        preg_match_all('#([^\s]+)', $formData['content'], $tags_from_content);

        $tagIds = [];
        foreach ($tags_from_content[1] as $tag) {
            Tag::create([
                'name'  => $tag,
                'slug'  => Str::slug($tag)
            ]);

            $tagIds[] = $newTag->id;
        }

        $formData['tags'] = $tagIds;

        $post = Post::create($formData);

        $post->tags()->attach($formData['tags']);


        return redirect()->route('admin.posts.show', $post->slug);
    }

    public function show(Post $post) {

        $tags = $post->tags->pluck('name');
        // dd($tags);

        return view('admin.posts.show', [
            'post' => $post,
            'pageTitle' => $post->title,
            'tags' => $tags
        ]);
    }

    public function edit(Post $post) {

        if (Auth::user()->id !== $post->user_id) abort(403);

        $categories = Category::all();
        $tags = tag::all();


        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ]);

    }

    public function update(Request $request, Post $post) {

        if (Auth::user()->id !== $post->user_id) abort(403);

        $request->validate($this->validator($post->id));

        // prendiamo i nuovi valori
        $newPostData = $request->all();

        $post->update($newPostData);

        $post->tags()->sync($newPostData['tags']);

        return redirect()->route('admin.posts.show', $post->slug);
    }

    public function destroy(Post $post) {

        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->tags()->detach();

        $post->delete();

        return redirect()->back();
    }
}
