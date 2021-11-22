<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;
    protected $fillable = [
        'day',
        'alerted',
        'alertable_id',
        'alertable_type',
        'field_name_date'
    ];

    public function alertable()
    {
        return $this->morphTo();
    }

    public static function createAlert($day, $field_name_date, $entity)
    {

    }

    public static function markAsAlerted()
    {
        
    }


}
