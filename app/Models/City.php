<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "slug",
        "icon",
    ];

    // Laravel Accessor
    public function setNameAttribute($value)
    {
        $this->attributes["name"] = $value;
        $this->attributes["slug"] = Str::slug($value);
    }

    // 1 record data city memiliki lebih dari 1 wedding package
    public function weddingPackages(): HasMany
    {
        // Disini kita menyimpan sebuah id record data pada wedding organizer
        return $this->hasMany(WeddingPackage::class);
    }
}
