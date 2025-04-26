<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasUuids;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'product_id',
        'order_number',
        'name',
        'email',
        'whatsapp',
        'license_type',
        'amount',
        'payment_proof',
        'payment_proof_uploaded_at',
        'status',
        'notes',
        'download_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'payment_proof_uploaded_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_proof_uploaded_at' => 'datetime',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Generate unique order number if not provided
            if (empty($order->order_number)) {
                $order->order_number = 'ORD-' . strtoupper(Str::random(8));
            }
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
