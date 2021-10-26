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
        }
        
        if($request['entry_date']!== null){
            $newEntryDate = Carbon::createFromFormat('d-m-Y', $request['entry_date']);
            $request['entry_date'] = $newEntryDate->format('Y-m-d');
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
        if($request->accepted_date){
            $newAcceptedDate = Carbon::createFromFormat('d-m-Y', $request->accepted_date);
            $request->request->remove('accepted_date');
            $request->request->add(['accepted_date' => $newAcceptedDate->format('Y-m-d')]);
            $daysLimit = $budget->project->type_project->budget_entry_days_limit;
            $request->request->add(['limit_entry_date' => $newAcceptedDate->addDays($daysLimit)->format('Y-m-d')]);
        }

        if($request->entry_date){
            $newEntryDate = Carbon::createFromFormat('d-m-Y', $request->entry_date);
            $request->request->remove('entry_date');
            $request->request->add(['entry_date' => $newEntryDate->format('Y-m-d')]);
        }

        if($request->hasFile('doc')){
            $dir = 'public/project/'.$budget->project_id.'/budget';
            if($budget->doc_path){
                Storage::delete($budget->doc_path);
            }
            $file = $request->doc;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            $request->request->add(['doc_path' => $path]);
        }

        $budget_update = $budget->update($request->all());

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
            'sent_customer' => ['label'=> 'Enviado al Cliente', 'class' =>'info'] ,
            'accepted' => ['label'=> 'Aceptado','class' =>'success'],
            'entered' => ['label'=> 'Ingresado','class' =>'warning'],
            'rejected' => ['label'=> 'Rechazado','class' =>'danger']
        ];

        return $status[$this->status];
    }
}
