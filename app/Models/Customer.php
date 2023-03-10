<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'address',
        'tel_number',
        'promo_10',
        'promo_25'
    ];

    /**
     * Get the user associated with the customer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
