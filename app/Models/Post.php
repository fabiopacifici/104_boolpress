<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'cover_image', 'content'];


    // TODO: shuld check if it exists
    public function generateSlug($title)
    {

        return Str::slug($title, '-');
    }
}
