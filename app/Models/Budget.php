<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'amount',
        'status',
        'doc_path',
        'accepted_date',
        'limit_entry_date',
        'entry_date',
        'project_id',
        
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public static function storeBudget($request)
    {

        if($request['accepted_date']!== null){
            $newAceptedDate = Carbon::createFromFormat('d-m-Y', $request['accepted_date']);
            $request['accepted_date'] = $newAceptedDate->format('Y-m-d');
            $daysLimit = Project::find($request['project_id'])->type_project->budget_entry_days_limit;
            $request['limit_entry_date'] = $newAceptedDate->addDays($daysLimit)->format('Y-m-d');
            $request['entry_date'] = $newAceptedDate->addDays($daysLimit)->format('Y-m-d');
        }

        $budget = Budget::create($request->all());
        $dir = 'public/project/'.$request['project_id'].'/budget';
        
        if(isset($request['doc'])){
            $file = $request['doc'];
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            $budget->doc_path = $path;
            $budget->save();
        }

        if($budget){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El presupuesto y proyecto se han creado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para crear el presupuesto+proyecto",
            );
            request()->session()->put('status', $status);
        }
        
        return $budget;
    }

    public static function updateBudget($request, $budget)
    {
        $budget->number = $request->number;
        $budget->amount = $request->amount;
        $budget->status = $request->status;

        $requestAcceptedDate = $request->accepted_date ? Carbon::createFromFormat('d-m-Y',$request->accepted_date) :null;
        $budgetAceptedDate = $budget->accepted_date ? Carbon::createFromFormat('Y-m-d',$budget->accepted_date) : null;

        $requestEntryDate = $request->entry_date ? Carbon::createFromFormat('d-m-Y',$request->entry_date): null;
        $budgetEntryDate = $budget->entry_date ? Carbon::createFromFormat('Y-m-d',$budget->entry_date): null;

        if($requestAcceptedDate){
            if($requestAcceptedDate != $budgetAceptedDate){
            
                $budget->accepted_date = $requestAcceptedDate->format('Y-m-d');
                $daysLimit = $budget->project->type_project->budget_entry_days_limit;
                $budget->limit_entry_date = $requestAcceptedDate->addDays($daysLimit)->format('Y-m-d');
                $budget->entry_date = $requestAcceptedDate->addDays($daysLimit)->format('Y-m-d');
            }
        }

        if($requestEntryDate){
            if($requestEntryDate != $budgetEntryDate){
                $budget->entry_date = $requestEntryDate->format('Y-m-d');
                $budget->limit_entry_date = $budget->entry_date;
            }
        }

        if(!isset($request->accepted_date) && !isset($request->entry_date)){
            $budget->accepted_date = null;
            $budget->entry_date = null;
        }

        if($request->hasFile('doc')){
            $dir = 'public/project/'.$budget->project_id.'/budget';
            if($budget->doc_path){
                Storage::delete($budget->doc_path);
            }
            $file = $request->doc;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            $budget->doc_path = $path;
        }
        
        $budget_update = $budget->save();

        if($budget_update){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El presupuesto se ha actualizado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para actualizar el presupuesto",
            );
            request()->session()->put('status', $status);
        }
        
        return $budget_update;
    }

    public static function destroyBudget($budget)
    {
        $budget_delete = $budget->delete();
        if( $budget_delete ){
            
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El presupuesto se ha borrado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para borrar el presupuesto",
            );
            request()->session()->put('status', $status);
        }

        return $budget_delete;
    }
    
    public static function statusUpdate($request, $budget)
    {
        $budget->status = $request->status;
        $budgetUpdateStatus = $budget->save();
        if($budgetUpdateStatus){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El estado del presupuesto se ha actualizado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para actualizar el estado del presupuesto",
            );
            request()->session()->put('status', $status);
        }

        return $budgetUpdateStatus;
    }

    public function statusLabels()
    {
        $status = [
            'accepted' => ['label'=> 'Aceptado','class' =>'success'],
            'entered' => ['label'=> 'Ingresado','class' =>'info'],
            'rejected' => ['label'=> 'Rechazado','class' =>'danger']
        ];

        return $status[$this->status];
    }
}
