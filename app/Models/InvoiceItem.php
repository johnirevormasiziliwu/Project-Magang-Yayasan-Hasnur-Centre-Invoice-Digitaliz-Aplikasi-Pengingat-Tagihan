<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
       
        'description',
        'stock',
        'unit',
        'price',
        'file',
        'nominal',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
