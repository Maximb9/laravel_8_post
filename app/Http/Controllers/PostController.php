<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::where('is_published', 0)->first();
        dump($post->title);

    }

    public function create()
    {
        $posts_arr = [
            [
                'title' => 'another post_4_create',
                'content' => 'another content_4_create',
                'image' => 'another image_4_create',
                'likes' => 20,
                'is_published' => 1
            ],
            [
                'title' => 'another post_5_create',
                'content' => 'another content_5_create',
                'image' => 'another image_5_create',
                'likes' => 50,
                'is_published' => 1
            ]
        ];

        foreach ($posts_arr as $item) {
            Post::create($item);
        }
    }

    public function update()
    {
        $post = Post::find(6);
        $post->update([
            'title' => 'another post_6_create',
            'content' => 'another content_6_create',
            'image' => 'another image_6_create',
            'likes' => 100,
            'is_published' => 0
        ]);
    }

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
        ],[
            'title' => 'my33e',
            'content' => 'some content_333_creqwerqwefate',
            'image' => 's234123553omeer image_5_crweeate',
            'likes' => 501,
            'is_published' => 1
        ]);

        dump($post->content);
        dd('finished');
    }

    public function updateOrCreate(){
        $post = Post::updateOrCreate([
            'content' => 'some11111 content_333_create111',
        ],[
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
