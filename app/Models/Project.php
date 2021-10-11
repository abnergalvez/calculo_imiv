<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'entry_number',
        'description',
        'address',
        'commune_id',
        'entry_date',
        'limit_re_entry_date',
        're_entry_date',
        'status',
        'entry_doc_path',
        're_entry_doc_path',
        'customer_id',
        'type_project_id',
    ];

    // public function setEntryDateAttribute($entry_date)
    // {
    //     return $this->attributes['entry_date'] = Carbon::createFromFormat('d-m-Y', $entry_date)->format('Y-m-d');
    // }

    // public function getEntryDateAttribute($entry_date)
    // {
    //     return $this->attributes['entry_date'] = Carbon::parse($entry_date)->format('d-m-Y');
    // }

    public function type_project()
    {
        return $this->belongsTo(TypeProject::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public static function createProject($request)
    {
        $newEntryDate = Carbon::createFromFormat('d-m-Y', $request->entry_date);
        $request->request->remove('entry_date');
        $request->request->add(['entry_date' => $newEntryDate->format('Y-m-d')]);
        $daysLimit = \App\Models\TypeProject::find($request->type_project_id)->re_entry_days_limit;
        $request->request->add(['limit_re_entry_date' => $newEntryDate->addDays($daysLimit)->format('Y-m-d')]);

        $project = Project::create($request->all());

        $dir = 'public/project/'.$project->id.'/entry_doc_path';

        if ($request->hasFile('entry_doc')){
            
            $file = $request->entry_doc;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            $project->entry_doc_path = $path;
            $project->save();

        }

        

        if($project){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El proyecto se ha creado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para crear el proyecto",
            );
            request()->session()->put('status', $status);
        }
        
        return $project;
        
    }


    public static function updateProject($request, $project)
    {
        $dir = 'public/project/'.$project.'/entry_doc_path';

        if ($request->hasFile('entry_doc')){
            
            if($project->entry_doc_path){
                Storage::delete($project->entry_doc_path);
            }
            $file = $request->entry_doc;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            $request->request->add(['entry_doc_path'=> $path]);
        }

        $newEntryDate = Carbon::createFromFormat('d-m-Y', $request->entry_date);
        $request->request->remove('entry_date');
        $request->request->add(['entry_date' => $newEntryDate->format('Y-m-d')]);
        $daysLimit = \App\Models\TypeProject::find($request->type_project_id)->re_entry_days_limit;
        $request->request->add(['limit_re_entry_date' => $newEntryDate->addDays($daysLimit)->format('Y-m-d')]);
        
        $project_update = $project->update($request->all());

        if($project){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El proyecto se ha actualizado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para actualizar el proyecto",
            );
            request()->session()->put('status', $status);
        }
       
        return $project_update;
        
    }


    public static function destroyProject($project)
    {
        if($project->entry_doc_path){
            Storage::delete($project->entry_doc_path);
        }
        
        $project_delete = $project->delete();

        if($project_delete){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El proyecto se ha eliminado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para eliminar el proyecto",
            );
            request()->session()->put('status', $status);
        }

        return $project_delete;
        
    }

    public static function statusForHummans($status_in)
    {
       $status = [
        'registered' => 'Ingresado',
        'in_evaluation' => 'En Evaluación',
        're_entered' => 'Re-Ingresado',
        'acepted' => 'Aceptado',
        'rejected' => 'Rechazado',
       ];

       return $status[$status_in];
    }

    
}
