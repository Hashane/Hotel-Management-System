<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key','value'];
    public static function getSettings($key){
        return Setting::where('key', $key)->first();
    }
}
