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
        'code_number',
        'entry_number',
        'description',
        'address',
        'commune_id',
        'entry_date',
        
        'limit_observation_date',
        'observation_date',

        'limit_re_entry_date',
        're_entry_date',

        'limit_final_status_date',
        'final_status_date',

        'status',
        'entry_doc_path',
        're_entry_doc_path',
        'customer_id',
        'reviser_id',
        'type_project_id',
    ];

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

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function reviser()
    {
        return $this->belongsTo(Reviser::class);
    }

    public function budget()
    {
        return $this->hasOne(Budget::class);
    }

    public static function createProject($request)
    {
        if($request->entry_date){
            $newEntryDate = Carbon::createFromFormat('d-m-Y', $request->entry_date);
            $request->request->remove('entry_date');
            $request->request->add(['entry_date' => $newEntryDate->format('Y-m-d')]);
            $daysLimit = \App\Models\TypeProject::find($request->type_project_id)->observation_days_limit;
            $request->request->add(['limit_observation_date' => $newEntryDate->addDays($daysLimit)->format('Y-m-d')]);
        }

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
        $dir = 'public/project/'.$project->id.'/entry_doc_path';

        if ($request->hasFile('entry_doc')){
            
            if($project->entry_doc_path){
                Storage::delete($project->entry_doc_path);
            }
            $file = $request->entry_doc;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            $request->request->add(['entry_doc_path'=> $path]);
        }

        if($request->entry_date){
            $newEntryDate = Carbon::createFromFormat('d-m-Y', $request->entry_date);
            $request->request->remove('entry_date');
            $request->request->add(['entry_date' => $newEntryDate->format('Y-m-d')]);
            $daysLimit = \App\Models\TypeProject::find($request->type_project_id)->observation_days_limit;
            $request->request->add(['limit_observation_date' => $newEntryDate->addDays($daysLimit)->format('Y-m-d')]);
        }

        if($request->observation_date){
            $newObservationDate = Carbon::createFromFormat('d-m-Y', $request->observation_date);
            $request->request->remove('observation_date');
            $request->request->add(['observation_date' => $newObservationDate->format('Y-m-d')]);
            $daysLimit = \App\Models\TypeProject::find($request->type_project_id)->re_entry_days_limit;
            $request->request->add(['limit_re_entry_date' => $newObservationDate->addDays($daysLimit)->format('Y-m-d')]);
        }

        if($request->re_entry_date){
            $newReEntryDate = Carbon::createFromFormat('d-m-Y', $request->re_entry_date);
            $request->request->remove('re_entry_date');
            $request->request->add(['re_entry_date' => $newReEntryDate->format('Y-m-d')]);
            $daysLimit = \App\Models\TypeProject::find($request->type_project_id)->final_status_days_limit;
            $request->request->add(['limit_final_status_date' => $newReEntryDate->addDays($daysLimit)->format('Y-m-d')]);
        }

        if($request->final_status_date){
            $newFinalStatusDate = Carbon::createFromFormat('d-m-Y', $request->final_status_date);
            $request->request->remove('final_status_date');
            $request->request->add(['final_status_date' => $newFinalStatusDate->format('Y-m-d')]);
        }


        
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

    public static function statusUpdate($request, $project)
    {
        $project->status = $request->status;

        if($request->status_date){
            $requestDate = Carbon::createFromFormat('d-m-Y', $request->status_date);
            $date = Project::statusDateChange($request->status)['date'];
            $days = Project::statusDateChange($request->status)['days'];
            $limit = Project::statusDateChange($request->status)['limit'];
            
            if(isset($date)){
                $project->$date = $requestDate->format('Y-m-d');
            }

            if(isset($days)){
                $daysLimit = \App\Models\TypeProject::find($project->type_project_id)->$days;
            }

            if(isset($limit)){
                $project->$limit =  $requestDate->addDays($daysLimit)->format('Y-m-d');
            }
        }

        $projectUpdateStatus = $project->save();
        if($projectUpdateStatus){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El estado + fechas del proyecto se ha actualizado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para actualizar el estado del proyecto",
            );
            request()->session()->put('status', $status);
        }

        return $projectUpdateStatus;
    }

    public static function reEntryUpdate($request, $project)
    {
        
        $dir = 'public/project/'.$project->id.'/re_entry_doc_path';
       
        if ($request->hasFile('entry_doc')){
            $file = $request->entry_doc;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            $project->re_entry_doc_path = $path;
        
        }
        
        $project->re_entry_date = Carbon::createFromFormat('d-m-Y', $request->re_entry_date)->format('Y-m-d');
        $project->status = $request->status;
        $projectUpdateStatus = $project->save();
        if($projectUpdateStatus){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El re-ingreso se ha realizado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para re-ingresar el proyecto",
            );
            request()->session()->put('status', $status);
        }

        return $projectUpdateStatus;
    }


    public static function createProjectFromBudget($request)
    {
        $project = Project::create($request); 
        return $project;   
    }

    public static function statusLabel($status_in)
    {
       if($status_in){
            $status = [
                'registered_for_observation' => 'Ingresado para observación',
                'in_correction' => 'En Corrección',
                're_entered' => 'Re-Ingresado',
                'accepted' => 'Aceptado',
                'rejected' => 'Rechazado',
                'in_budget' => 'En Presupuesto'
            ];
        
            return $status[$status_in];
       }

       return ' - ';

    }


    public static function statusColor($status_in)
    {
       if($status_in){
            $status = [
                'registered_for_observation' => '#2361ce',
                'in_correction' => '#FBA918',
                're_entered' => '#fb503b',
                'accepted' => '#10B981',
                'rejected' => '#E11D48',
                'in_budget' => '#63b1bd'
            ];
        
            return $status[$status_in];
       }
       return '#374151';
    }

    public function statusForHummans()
    {
       if($this->status){
            $status = [
                'registered_for_observation' => 'Ingresado para observación',
                'in_correction' => 'En Corrección',
                're_entered' => 'Re-Ingresado',
                'accepted' => 'Aceptado',
                'rejected' => 'Rechazado',
                'in_budget' => 'En Presupuesto'
            ];
        
            return $status[$this->status];
       }

       return ' - ';

    }

    public function statusClassBadge()
    {
       
        if($this->status){
            $statusBadge = [
                'registered_for_observation' => 'info',
                'in_correction' => 'warning text-dark',
                're_entered' => 'info',
                'accepted' => 'success',
                'rejected' => 'danger',
                'in_budget' => 'primary',
            ];
        
            return $statusBadge[$this->status];
       }
       return 'secondary';

    }


    public static function statusDateChange($status)
    {
       
        if($status){
            $statusDate = [
                'registered_for_observation' => 
                [
                    'date' => 'entry_date' ,
                    'limit' => 'limit_observation_date',
                    'days' => 'observation_days_limit',
                ],

                'in_correction' => 
                [
                    'date' => 'observation_date',
                    'limit' => 'limit_re_entry_date',
                    'days' => 're_entry_days_limit',
                ],
                
                're_entered' => 
                [
                    'date' => 're_entry_date' ,
                    'limit' => 'limit_final_status_date',
                    'days' => 'final_status_days_limit',
                ],
                
                'accepted' => 
                [
                    'date' => 'final_status_date' ,
                    'limit' => null,
                    'days' => null,
                ],
                
                'rejected' => 
                [
                    'date' => 'final_status_date' ,
                    'limit' => null,
                    'days' => null,
                ],
                
                'in_budget' => 
                [
                    'date' => null ,
                    'limit' => null,
                    'days' => null,
                ],
            ];
        
            return $statusDate[$status];
       }
       return null;
    }

    
}
