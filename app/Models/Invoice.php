<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Invoice extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    protected $fillable = [
        'user_id',
        'invoice_number',
        'customer_id',
        'title',
        'invoice_date',
        'due_date',
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

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

   

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preveiew')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
}
