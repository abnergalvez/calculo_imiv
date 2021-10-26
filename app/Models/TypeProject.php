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
        'budget_entry_days_limit',
        'observation_days_limit',
        're_entry_days_limit',
        'final_status_days_limit',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public static function storeTypeProject($request)
    {
        $type_project = TypeProject::create($request->all());

        if($type_project){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El tipo de proyecto se ha creado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para crear el tipo de proyecto",
            );
            request()->session()->put('status', $status);
        }

        return $type_project;
    }

    public static function updateTypeProject($request, $type_project)
    {
        
        if($type_project->update($request->all())){
            
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El tipo de proyecto se ha actualizado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para actualizar al tipo de proyecto",
            );
            request()->session()->put('status', $status);
        }

        return $type_project;
    }

    public static function destroyTypeProject($type_project)
    {
        if($type_project->projects->count() == 0){
            
            $type_project_delete = $type_project->delete();
            if( $type_project_delete ){
                
                $status = array(
                    'time' => 4,
                    'type' => "success",
                    'message' => "El tipo de proyecto se ha borrado correctamente.",
                );
                request()->session()->put('status', $status);

            }else{
                $status = array(
                    'time' => 4,
                    'type' => "danger",
                    'message' => "Hay un problema para borrar al tipo de proyecto",
                );
                request()->session()->put('status', $status);
            }

            return $type_project_delete;

        }else{
            
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "El tipo de proyecto tiene asociados proyectos y no se puede borrar.",
            );
            request()->session()->put('status', $status);

            return $type_project;
        }
        
        
    }
}
