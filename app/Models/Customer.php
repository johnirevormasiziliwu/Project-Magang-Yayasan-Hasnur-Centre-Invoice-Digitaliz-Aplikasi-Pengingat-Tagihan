<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;
   

    protected $fillable = [
        'user_id',
        'name_agency',
        'name_unit',
        'name_pic',
        'no_handphone',
        'email',
        'address',
        'password',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   

   
    
}
