<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeddingBonusPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "wedding_package_id",
        "bonus_package_id",
    ];

    // 1 Wedding package dimiliki oleh 1 wedding organizer
    public function weddingPackage(): BelongsTo
    {
        // Disini kita menyimpan sebuah id record data pada wedding organizer
        return $this->belongsTo(WeddingPackage::class, "wedding_organizer_id");
    }

    // 1 Wedding package dimiliki oleh 1 wedding organizer
    public function bonusPackage(): BelongsTo
    {
        // Disini kita menyimpan sebuah id record data pada wedding organizer
        return $this->belongsTo(BonusPackage::class, "bonus_package_id");
    }
}
