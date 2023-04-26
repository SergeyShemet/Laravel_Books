<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Books extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'author',
        'slug',
        'rating',
        'categories_id',
        'rating',
        'description'
      ];

    public function category() {
        return $this->belongsTo(Categories::class);
    }
    public function comment() {
        return $this->hasMany(Comments::class);
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
