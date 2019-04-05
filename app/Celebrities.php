<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Celebrities extends Model
{
    protected $fillable = [
        'name', 'description','height','weight','networth','image','top'
    ];
}
