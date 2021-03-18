<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * The categories that belong to the article.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'article_categories', 'article_id', 'category_id');
    }

    /**
     * Get the ratings for the article.
     */
    public function ratings()
    {
        return $this->hasOne(Rate::class);
    }

    /**
     * Get the views for the article.
     */
    public function views()
    {
        return $this->hasMany(View::class);
    }
}
