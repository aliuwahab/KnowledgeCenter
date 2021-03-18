<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    /**
     * Get the article that owns the view.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
