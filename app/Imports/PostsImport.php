<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection( Collection $collection )
    {
        foreach ($collection as $item) {

            if (isset($item[1]) && $item[1] != null) {
                Post::firstOrCreate([
                    'title' => $item[1],
                ],[
                    'title' => $item[1],
                    'content' => $item[2],
                    'image' => $item[3],
                    'likes' => $item[4],
                    'is_published' => $item[5],
                    'category_id' => $item[6],


                ]);
            }
        }
    }
}
