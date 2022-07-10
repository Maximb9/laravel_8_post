<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::All();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('post.create', compact('categories', 'tags'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => ''
        ]);

        $tags = $data['tags'];
        unset($data['tags']);


        $post = Post::create($data);
//        возьмем $post у него есть tags... Переходим в Models Post, у него есть метод tags()
//        и есть соеденительная таблица post_tags (pivot) и в этой таблице привяжи вот к этому посту
//        привяжи теги. Какие теги мы укажим здесь (принимает массив [] поэтому можем указать $tags).
//        метод attach связывате посты и теги.
        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }

    public function show( Post $post )
    {

        return view('post.show', compact('post'));
    }

    public function edit( Post $post )
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update( Post $post )
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => ''
        ]);

        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
// метод sync удаляет и добавляет новые... обновляет, те которые есть не трогает, а добавляет новые.
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy( Post $post )
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
