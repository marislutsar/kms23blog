<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function url(): Attribute {
        return Attribute::get(function (){
            if(parse_url($this->path, PHP_URL_SCHEME)){
                return $this->path;
            }
            return Storage::disk('public')->url($this->path);
        });
    }
}
