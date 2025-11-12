<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeddingTestimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "photo",
        "wedding_package_id",
        "message",
        "occupation",
    ];

    // 1 Wedding testimonial dimiliki oleh 1 wedding organizer
    public function weddingPackage(): BelongsTo
    {
        // Disini kita menyimpan sebuah id record data pada wedding organizer
        return $this->belongsTo(WeddingPackage::class, "wedding_package_id");
    }
}
