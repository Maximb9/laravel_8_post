<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
//        $category = Category::find(1);
//
//        dd($category->posts);

        $post = Post::find(1);
        $tag = Tag::find(1);

        dd($tag->posts);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);

        Post::create($data);

        return redirect()->route('post.index');
    }

    public function show( Post $post )
    {

        return view('post.show', compact('post'));
    }

    public function edit( Post $post )
    {

        return view('post.edit', compact('post'));
    }

    public function update( Post $post )
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);

        $post->update($data);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

//    public function update()
//    {
//        $post = Post::find(6);
//        $post->update([
//            'title' => 'another post_6_create',
//            'content' => 'another content_6_create',
//            'image' => 'another image_6_create',
//            'likes' => 100,
//            'is_published' => 0
//        ]);
//    }

    public function delete()
    {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd($post);
    }

    public function firstOrCreate()
    {
        $post = Post::firstOrCreate([
            'image' => 'some image_5_create555',
        ], [
            'title' => 'my33e',
            'content' => 'some content_333_creqwerqwefate',
            'image' => 's234123553omeer image_5_crweeate',
            'likes' => 501,
            'is_published' => 1
        ]);

        dump($post->content);
        dd('finished');
    }

    public function updateOrCreate()
    {
        $post = Post::updateOrCreate([
            'content' => 'some11111 content_333_create111',
        ], [
            'title' => '111',
            'content' => 'some11111 content_333_create111',
            'image' => '111',
            'likes' => 111,
            'is_published' => 0
        ]);

        dump($post->content);
        dd('finished');
    }
}
