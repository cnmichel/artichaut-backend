<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * Get the user associated with the customer.
     */
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
