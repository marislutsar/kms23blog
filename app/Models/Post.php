<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = ['title', 'body', 'image'];

    // public function getSnippetAttribute(){
    //     return explode("\n\n", $this->body)[0];
    // }

    public function snippet(): Attribute {
        return Attribute::get(function (){
            return explode("\n\n", $this->body)[0];
        });
    }

    public function displayBody(): Attribute {
        return Attribute::get(function (){
            return nl2br($this->body);
        });
    }

    public function displayImage(): Attribute {
        return Attribute::get(function (){
            if(!$this->image || parse_url($this->image, PHP_URL_SCHEME)){
                return $this->image;
            }
            return Storage::disk('public')->url($this->image);
        });
    }

    public function image(): Attribute {
        return Attribute::set(function ($image){
            if($image instanceof UploadedFile){
                return $image->store('', ['disk' => 'public']);
            }
            return $image;
        });
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::deleted(function (Post $post) {
            if($post->image){
                Storage::disk('public')->delete($post->image);
            }
        });
    }
}
