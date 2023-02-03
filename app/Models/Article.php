<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
        'lang_id'
    ];

    /**
     * Get the user associated with the article.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lang associated with the article.
     */
    public function lang()
    {
        return $this->belongsTo(Lang::class);
    }
}
