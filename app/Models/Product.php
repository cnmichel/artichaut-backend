<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'active',
        'lang_id'
    ];

    /**
     * Get the lang associated with the article.
     */
    public function lang()
    {
        return $this->belongsTo(Lang::class);
    }

}
