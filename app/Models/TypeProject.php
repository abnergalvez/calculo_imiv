<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        're_entry_days_limit',
    ];

    public function projects()
    {
        $this->hasMany(Project::class);
    }
}
