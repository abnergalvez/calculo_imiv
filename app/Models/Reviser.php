<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'contact'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public static function storeReviser($request)
    {
        $reviser = Reviser::create($request->all());

        if($reviser){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "La entidad revisora se ha creado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para crear a la entidad revisora",
            );
            request()->session()->put('status', $status);
        }

        return $reviser;
    }

    public static function updateReviser($request,$reviser)
    {
        $reviser_update = $reviser->update($request->all());
        if($reviser_update){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "La entidad revisora se ha actualizado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para actualizar a la entidad revisora",
            );
            request()->session()->put('status', $status);
        }
        return $reviser_update;
    }

    public static function destroyReviser($reviser)
    {
        $reviser_delete = $reviser->delete();
        if( $reviser_delete ){
            
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "La entidad revisora se ha borrado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para borrar a la entidad revisora",
            );
            request()->session()->put('status', $status);
        }

        return $reviser_delete;
    }
}
