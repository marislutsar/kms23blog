<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getAllChildrenPostsQuery(): Attribute {
        $ids = $this->getAllChildrenIds;
        $ids[] = $this->id;
        return Attribute::get(function () use ($ids) {
            return Post::whereIn('category_id', $ids);
        });
    }

    public function getAllChildrenIds(): Attribute {
        return Attribute::get(function (){
            $childIds = [];
            foreach($this->children as $child){
                $childIds[] = $child->id;
                if($child->children->count()){
                    $childIds[] = $child->getAllChildrenIds;
                }
            }
            return collect($childIds)->flatten();
        });
    }
}
