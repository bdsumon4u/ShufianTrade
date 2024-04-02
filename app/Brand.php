<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'slug', 'image_id',
    ];

    public static function booted()
    {
        static::saved(function () {
            cache()->forget('brands');
        });

        static::deleting(function () {
            cache()->forget('brands');
        });
    }

    public static function cached()
    {
        return cache()->rememberForever('brands', function () {
            return Brand::all();
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
