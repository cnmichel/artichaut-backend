<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rating',
        'title',
        'content',
        'user_id'
    ];

    /**
     * Get the user associated with the customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the lang associated with the review.
     */
    public function lang()
    {
        return $this->belongsTo(Lang::class);
    }
}
