<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WeddingOrganizer extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "slug",
        "icon",
        "phone"
    ];

    // Laravel Accessor, untuk menyimpan slug sesuai dengan nama yang ditentukan pada database
    public function setNameAttribute($value)
    {
        $this->attributes["name"] = $value;
        $this->attributes["slug"] = Str::slug($value);
    }

    // 1 Wedding Organizer menyimpan beberapa wedding package
    public function weddingPackages(): HasMany
    {
        return $this->hasMany(WeddingPackage::class);
    }
}
