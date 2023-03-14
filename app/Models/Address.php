<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */

   protected $fillable = [
       'name',
       'street',
       'city',
       'zip_code',
       'country',
       'customer_id'
   ];

   public function customer()
   {       
       return $this->belongsTo(Customer::class);

   }
}
