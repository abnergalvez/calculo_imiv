<?php

namespace App\Models;
use Carbon\Carbon;
use App\Models\Alert;
use Illuminate\Support\Facades\Http;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', //Nombre del Feriado
        'date', // Año-mes-día
        'type', // Religioso , Civil , Otro
    ];

    public static function isHolidayDate($date)
    {
        return count(Holiday::where('date',$date)->get()) ? true : false;
    }
}
