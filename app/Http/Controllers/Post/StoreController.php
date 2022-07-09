<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class StoreController extends Controller
{
    public function __invoke()
    {
        $data = request()->validate([
            'title' => 'required|string',
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
}
