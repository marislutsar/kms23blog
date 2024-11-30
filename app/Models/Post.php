<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string|null $body
 * @property string|null $image
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read mixed $display_body
 * @property-read mixed $display_image
 * @property-read mixed $snippet
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PostFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post whereUserId($value)
 * @mixin \Eloquent
 */
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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
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
