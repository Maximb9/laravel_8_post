<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use Filterable;
    public function posts() {

      return $this->belongsToMany(Post::Class, 'post_tags', 'tag_id', 'post_id');
    }
}
