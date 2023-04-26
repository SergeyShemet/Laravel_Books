<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categories extends Model
{
    use HasFactory;

    public function books() {
        return $this->hasMany(Books::class);
    }

    function createSlug($title){
        if (static::whereslug($slug = Str::slug($title))->exists()) {
            $max = static::wheretitle($title)->latest('id')->value('slug');

            if (is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}_2";
        }
        return $slug;
    }

    public function getRouteKeyName() {
        return 'slug';
    }

}
