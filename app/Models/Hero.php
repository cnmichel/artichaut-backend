<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'cta',
        'lang_id'
    ];

    /**
     * Get the lang associated with the article.
     */
    public function lang()
    {
        return $this->hasOne(Lang::class);
    }
}
