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

    public static function markAsAlerted()
    {
        
    }

    public static function createAlert($day, $field_name_date, $entity)
    {

        $result = $entity->alerts()->create([
            'day' => $day,
            'field_name_date' => $field_name_date,
            'alerted' => 0
        ]);

        return $result ? true : false ;
    }



    public static function deleteAllDocuments($entity)
    {
        $documents = $entity->documents;
        foreach ($documents as $doc) {
            Storage::delete($doc->path);
            $doc->delete();
        }
    }

    public static function deleteAlert($path)
    {
        $doc = Document::where('path', $path);
        Storage::delete($path);
        $doc->delete();
    }


}
