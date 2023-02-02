<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * Get the user associated with the article.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the lang associated with the article.
     */
    public function lang()
    {
        return $this->hasOne(Lang::class);
    }
}
