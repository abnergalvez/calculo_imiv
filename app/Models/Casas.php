<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casas extends Model
{
    use HasFactory;

    public static function proyectos()
    {
        $proyecto = [
            "" => "basico",
            
        ];
    }
}
