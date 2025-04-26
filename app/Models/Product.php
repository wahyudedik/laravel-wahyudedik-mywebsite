<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasUuids;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_user',
        'price_developer',
        'category',
        'image',
        'file_path',
        'demo_link',
        'featured',
        'rating',
        'reviews_count',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Accessor untuk average_rating (untuk kompatibilitas dengan view)
    public function getAverageRatingAttribute()
    {
        return $this->rating ?? 0;
    }

    // Accessor untuk reviews_count (untuk kompatibilitas dengan view)
    public function getReviewsCountAttribute()
    {
        return $this->reviews_count ?? 0;
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Metode untuk menghitung ulang rating
    public function recalculateRating()
    {
        $reviews = $this->reviews()->where('is_approved', true)->get();
        $count = $reviews->count();

        if ($count > 0) {
            $this->rating = $reviews->avg('rating');
            $this->reviews_count = $count;
            $this->save();
        }

        return $this;
    }
}
