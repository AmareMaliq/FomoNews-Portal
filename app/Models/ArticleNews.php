<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleNews extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    //asesor
    // kalau gamau munculin slug ke form
    public function SetNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author() : BelongsTo
    {
        return $this->belongsTo(Author::class,'author_id');
    }
}
