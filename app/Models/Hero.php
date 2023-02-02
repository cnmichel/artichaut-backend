<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    /**
     * Get the lang associated with the article.
     */
    public function lang()
    {
        return $this->hasOne(Lang::class);
    }
}
