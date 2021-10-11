<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tag',
        'label',
    ];

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }

    public function communes()
    {
        return $this->hasManyThrough(Commune::class, Province::class);
    }
}
