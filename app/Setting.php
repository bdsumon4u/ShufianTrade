<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'name', 'value',
    ];

    public static function booted()
    {
        static::saved(function ($setting) {
            Cache::put('settings:'.$setting->name, $setting);
            Cache::forget('settings');
        });
    }

    public static function array()
    {
        return Cache::rememberForever('settings', function () {
            return self::all()->flatMap(function ($setting) {
                return [$setting->name => $setting->value];
            })->toArray();
        });
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = json_encode($value);
    }

    public function getValueAttribute($value)
    {
        return json_decode($value);
    }
}
