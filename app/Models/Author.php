<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    //asesor
    // kalau gamau munculin slug ke form
    public function SetNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function news() : HasMany
    {
        return $this->hasMany(ArticleNews::class);
    }
}