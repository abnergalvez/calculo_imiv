<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'label',
        'province_id',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
