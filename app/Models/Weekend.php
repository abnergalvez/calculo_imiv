<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Alert;
use Illuminate\Support\Facades\Http;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weekend extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Sabado / Domingo
        'date', // Año-mes-dia
        'type', //Fin de Semana
    ];

    public static function isWeekendDate($date)
    {
        return count(Weekend::where('date',$date)->get()) ? true : false;
    }
}

