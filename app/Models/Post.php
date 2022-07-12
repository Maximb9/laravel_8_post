<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;
//    protected $table = 'posts';
    use Filterable;

    public function category()
    {
        return $this->belongsTo(Category::Class, 'category_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::Class, 'post_tags', 'post_id', 'tag_id');
    }
}
