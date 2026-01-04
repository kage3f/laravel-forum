<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Topic extends Model
{
    protected $fillable = ['uuid', 'title', 'slug', 'content', 'user_id', 'category_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($topic) {
            $topic->uuid = (string) Str::uuid();
            if (empty($topic->slug)) {
                $topic->slug = Str::slug($topic->title) . '-' . Str::random(5);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
