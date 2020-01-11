<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingsMapApi extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'map_api'
    ];
}
