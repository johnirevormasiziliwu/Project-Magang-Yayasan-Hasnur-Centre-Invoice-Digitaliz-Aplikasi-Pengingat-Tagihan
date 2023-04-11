<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_id',
        'customer_id',
        'title',
        'invoice_date',
        'due_date',
        'price',
        'stock',
        'unit',
        'nominal',
        'payment_receipt',
        'payment_time',
        'is_paid',
        
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search']) ? $filters['search'] : false) {
            return $query->where('invoice_id', 'like', '%' . $filters['search'] . '%')
                ->orWhere('title', 'like', '%' . $filters['search'] . '%')
                ->orWhere('customer_id', 'like', '%' . $filters['search'] . '%');
        }
    }
}
