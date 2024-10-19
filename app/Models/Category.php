<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];
    public $timestamps = false;

    public function advertises()
    {
        return $this->hasMany(Advertise::class);
    }
}
