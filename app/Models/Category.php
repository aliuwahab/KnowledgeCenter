<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;


    /**
     * The articles that belong to the category.
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_categories',  'category_id', 'article_id');
    }
}
