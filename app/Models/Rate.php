<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';

    protected $guarded = ['id'];

    /**
     * Get the article that owns the rating.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
