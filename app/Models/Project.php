<?php

namespace App\Models;
use Carbon\Carbon;
use App\Models\TypeProject;
use App\Models\Alert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

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

        'adjudication_date',
        'to_engineer_date',
        'engineer_user_id',
        'approval_link',
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

    public function alerts()
    {
        return $this->morphMany(Alert::class, 'alertable');
    }

    public static function createProject($request)
    {
        $project = new Project;
        $project->name = $request->name;
        $project->code = $request->code;
        $project->code_number = $request->code_number;
        $project->entry_number = $request->entry_number;
        $project->description = $request->description;
        $project->address = $request->address;
        $project->commune_id = $request->commune_id;
        $project->status = $request->status;
        $project->customer_id = $request->customer_id;
        $project->reviser_id = $request->reviser_id;
        $project->type_project_id = $request->type_project_id;
        
        if($request->adjudication_date){
            $project->adjudication_date = Carbon::createFromFormat('d-m-Y',$request->adjudication_date);  
        }
        if($request->to_engineer_date){
            $project->to_engineer_date = Carbon::createFromFormat('d-m-Y',$request->to_engineer_date); 
        }
        
        $project->engineer_user_id = $request->engineer_user_id;

        $project->save();

        if($request->entry_date){
            Project::changeEntryDate($request->entry_date, true, $project);
        }

        $dir = 'public/project/'.$project->id.'/entry_doc_path';
        if ($request->hasFile('entry_doc')){
            
            $file = $request->entry_doc;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            $project->entry_doc_path = $path;
            $project->save();

        }

        // Creacion de Alertas

        if($project->isAllLimitDays()){
            $alert_day = $project->re_entry_date;
            $alert_field = 're_entry_date';
        }

        if($project->isDirectFinalEvaluation()){

            $alert_day = $project->final_status_days_limit;
            $alert_field = 'final_status_date';
        }

        if($project->isAllLimitDays() || $project->isDirectFinalEvaluation()){

            $day1 = Project::dateWithOutHolyday(Carbon::parse($alert_day)->subDays(1)->format('Y-m-d'));
            $day2 = Project::dateWithOutHolyday(Carbon::parse($day1)->subDays(1)->format('Y-m-d'));
            $day3 = Project::dateWithOutHolyday(Carbon::parse($day2)->subDays(1)->format('Y-m-d'));
            Alert::createAlert($day1,  $alert_field, $project);
            Alert::createAlert($day2,  $alert_field, $project);
            Alert::createAlert($day3,  $alert_field, $project);
        }

        
        //

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
        $project->name = $request->name;
        $project->code = $request->code;
        $project->code_number = $request->code_number;
        $project->entry_number = $request->entry_number;
        $project->description = $request->description;
        $project->address = $request->address;
        $project->commune_id = $request->commune_id;
        $project->status = $request->status;
        $project->customer_id = $request->customer_id;
        $project->reviser_id = $request->reviser_id;
        $project->type_project_id = $request->type_project_id;

        if($request->adjudication_date){
            $project->adjudication_date = Carbon::createFromFormat('d-m-Y',$request->adjudication_date);  
        }
        if($request->to_engineer_date){
            $project->to_engineer_date = Carbon::createFromFormat('d-m-Y',$request->to_engineer_date); 
        }

        $project->engineer_user_id = $request->engineer_user_id;
        $project->approval_link = $request->approval_link;
        
        $dir = 'public/project/'.$project->id.'/entry_doc_path';

        if ($request->hasFile('entry_doc')){
            
            if($project->entry_doc_path){
                Storage::delete($project->entry_doc_path);
            }
            $file = $request->entry_doc;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            
            $project->entry_doc_path = $path;
        }

        $dir2 = 'public/project/'.$project->id.'/re_entry_doc_path';
       
        if ($request->hasFile('re_entry_doc')){
            $file = $request->re_entry_doc;
            $path = $file->storeAs($dir2, $file->getClientOriginalName());
            $project->re_entry_doc_path = $path;
        
        }

        $project_update = $project->save();

        $requestEntryDate = $request->entry_date ? Carbon::createFromFormat('d-m-Y',$request->entry_date) :'';
        $projectEntryDate = $project->entry_date ? Carbon::createFromFormat('Y-m-d',$project->entry_date) : '';

        $requestObservationDate = $request->observation_date ? Carbon::createFromFormat('d-m-Y',$request->observation_date): '';
        $projectObservationDate = $project->observation_date ? Carbon::createFromFormat('Y-m-d',$project->observation_date): '';

        $requestReEntryDate = $request->re_entry_date ? Carbon::createFromFormat('d-m-Y',$request->re_entry_date): '';
        $projectReEntryDate = $project->re_entry_date ? Carbon::createFromFormat('Y-m-d',$project->re_entry_date): '';

        $requestFinalStatusDate = $request->final_status_date ? Carbon::createFromFormat('d-m-Y',$request->final_status_date): '';
        $projectFinalStatusDate = $project->final_status_date ? Carbon::createFromFormat('Y-m-d',$project->final_status_date): '';

        if($request->entry_date){
            if($requestEntryDate != $projectEntryDate){    
                Project::changeEntryDate($request->entry_date, true, $project);
            }
        }

        if($request->observation_date){
            if($requestObservationDate != $projectObservationDate){
                Project::changeObservation($request->observation_date, true, $project, 0);
            }
        }

        if($request->re_entry_date ){
            if($requestReEntryDate != $projectReEntryDate){
                Project::changeReEntryDate($request->re_entry_date, true, $project, 0);
            }
        }

        if($request->final_status_date ){
            if($requestFinalStatusDate != $projectFinalStatusDate ){
                Project::changeFinalStatusDate($request->final_status_date, true, $project, 0);
            }
        }

        

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
            $nameFunction = Project::statusDateChange($request->status)['function'];

            if(isset($days)){
                $daysLimit = TypeProject::find($project->type_project_id)->$days;
            }

            if(isset($limit)){
                $project->$limit =  $requestDate->addDays($daysLimit)->format('Y-m-d');
            }

            if(isset($date)){
                $project->$date = $requestDate->format('Y-m-d');
                if($nameFunction){
                    //dd($request->status_date);
                    Project::$nameFunction($request->status_date, true, $project,0);
                }
            }
        }

        $dir = 'public/project/'.$project->id.'/re_entry_doc_path';
       
        if ($request->hasFile('re_entry_doc')){
            $file = $request->re_entry_doc;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            $project->re_entry_doc_path = $path;
        
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
                'adjudication' => 'Adjudicado',
                'to_engineer' => 'Entregado a Ingeniero',
                'registered_for_observation' => 'Primer Ingreso',
                'in_correction' => 'Observaciones',
                're_entered' => 'Segundo Ingreso',
                'accepted' => 'Aprobación',
                'rejected' => 'Rechazo',
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
                'adjudication' => '#FBA918',
                'to_engineer' => '#63b1bd',
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
                'adjudication' => 'Adjudicado',
                'to_engineer' => 'Entregado a Ingeniero',
                'registered_for_observation' => 'Primer Ingreso',
                'in_correction' => 'Observaciones',
                're_entered' => 'Segundo Ingreso',
                'accepted' => 'Aprobación',
                'rejected' => 'Rechazo',
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
                'adjudication' => 'warning text-dark',
                'to_engineer' => 'primary',
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
                    'function' => 'changeEntryDate',
                ],

                'in_correction' => 
                [
                    'date' => 'observation_date',
                    'limit' => 'limit_re_entry_date',
                    'days' => 're_entry_days_limit',
                    'function' => 'changeObservation',
                ],
                
                're_entered' => 
                [
                    'date' => 're_entry_date' ,
                    'limit' => 'limit_final_status_date',
                    'days' => 'final_status_days_limit',
                    'function' => 'changeReEntryDate',
                ],
                
                'accepted' => 
                [
                    'date' => 'final_status_date' ,
                    'limit' => null,
                    'days' => null,
                    'function' => 'changeFinalStatusDate',
                ],
                
                'rejected' => 
                [
                    'date' => 'final_status_date' ,
                    'limit' => null,
                    'days' => null,
                    'function' => null,
                ],
                
                'in_budget' => 
                [
                    'date' => null ,
                    'limit' => null,
                    'days' => null,
                    'function' => null,
                ],
                
                'adjudication' => 
                [
                    'date' => 'adjudication_date' ,
                    'limit' => null,
                    'days' => null,
                    'function' => null,
                ],
                
                'to_engineer' => 
                [
                    'date' => 'to_engineer_date' ,
                    'limit' => null,
                    'days' => null,
                    'function' => null,
                ]
            ];
        
            return $statusDate[$status];
       }
       return null;
    }


    public static function changeEntryDate($date, $changeFormat, $project) 
    {    
        
        if($project->isAllLimitDays()){

            $observation_days_limit = $project->type_project->observation_days_limit;
            $re_entry_days_limit = $project->type_project->re_entry_days_limit;
            $final_status_days_limit = $project->type_project->final_status_days_limit;
    
            $date = $changeFormat ? Carbon::createFromFormat('d-m-Y', $date) : $date;
            $project->entry_date = $date;
            $project->save();
    
            $observation_date = Project::changeObservation($date , false, $project,$observation_days_limit);

        }elseif($project->isDirectFinalEvaluation()){
            
            $final_status_days_limit = $project->type_project->final_status_days_limit;
            $date = $changeFormat ? Carbon::createFromFormat('d-m-Y', $date) : $date;
            $project->entry_date = $date;

            $project->observation_date = null;
            $project->limit_observation_date = null;
            $project->re_entry_date = null;
            $project->limit_re_entry_date = null;
            $project->save();

            Project::changeFinalStatusDate($date, false, $project, $final_status_days_limit);

        }elseif($project->isNotRegisteredLimitDays()){

            return false;    

        }else{
            return false;
        }

        return $project;
    }

    public static function changeObservation($date, $changeFormat, $project , $days) 
    {
        $re_entry_days_limit = $project->type_project->re_entry_days_limit;
        $final_status_days_limit = $project->type_project->final_status_days_limit;

        $date = $changeFormat ? Carbon::createFromFormat('d-m-Y', $date) : $date;
        $project->observation_date = $date->addDays($days)->format('Y-m-d');
        $re_entry_date = Project::changeReEntryDate(Carbon::createFromFormat('Y-m-d', $project->observation_date), false, $project,$re_entry_days_limit );

        $project->observation_date = Project::dateWithOutHolyday($project->observation_date);
        $project->limit_observation_date = $project->observation_date;
        $project->save();

        return $project->observation_date;
    }

    public static function changeReEntryDate($date, $changeFormat, $project , $days) 
    {
        $final_status_days_limit = $project->type_project->final_status_days_limit;
        
        $date = $changeFormat ? Carbon::createFromFormat('d-m-Y', $date) : $date;
        $project->re_entry_date = $date->addDays($days)->format('Y-m-d');
        Project::changeFinalStatusDate(Carbon::createFromFormat('Y-m-d', $project->re_entry_date), false, $project,$final_status_days_limit );

        $project->re_entry_date = Project::dateWithOutHolyday($project->re_entry_date);
        $project->limit_re_entry_date = $project->re_entry_date;
        $project->save();

        return $project->re_entry_date;
    }

    public static function changeFinalStatusDate($date, $changeFormat, $project, $days) 
    {
        $date = $changeFormat ? Carbon::createFromFormat('d-m-Y', $date) : $date;
        $project->final_status_date = $date->addDays($days)->format('Y-m-d');
        $project->limit_final_status_date = $project->final_status_date;
 
        $project->final_status_date = Project::dateWithOutHolyday($project->final_status_date);
        $project->limit_final_status_date = $project->final_status_date;
        
        if($project->isDirectFinalEvaluation()){
            
            $project->observation_date = null;
            $project->limit_observation_date = null;
            $project->re_entry_date = null;
            $project->limit_re_entry_date = null;
            
        }

        $project->save();
        return $project->final_status_date;
    }

    //Procesa una fecha, verifica si no es feriado ni sabado / domingo y 
    //si es feriado trae la anterior mas cercana.

    public static function dateWithOutHolyday($date)
    {
        $habilDate = false;
        
        while($habilDate == false) 
        {
            $holyDay = Project::isHolydayinChile($date);
            $weekEndDay = Project::isWeekEndDay($date);

            if($weekEndDay){
                $date = Carbon::createFromFormat('Y-m-d', $date);
                $date =  $date->subDays(1)->format('Y-m-d');
                
            }else{
                if($holyDay){
                    $date = Carbon::createFromFormat('Y-m-d', $date);
                    $date =  $date->subDays(1)->format('Y-m-d');
                   
                }else{
                    $habilDate = true;
                    $exitDate =  $date;
                }
            }

        }
        return $exitDate;
    }
    // date Y-m-d
    public static function isHolydayinChile($date)
    {
        $date_format = Carbon::createFromFormat('Y-m-d', $date)->format('Y/m/d');
        $response = Http::get('https://apis.digital.gob.cl/fl/feriados/'.$date_format);
        if($response->json() && isset($response->json()['error']))
        {
            return false;
        }
        return true; 
    }
    // date Y-m-d
    public static function isWeekEndDay($date)
    {
        $day = Carbon::createFromFormat('Y-m-d', $date);
        return $day->isWeekend() ? $day->isWeekend() : false;  
    }

    public function isAllLimitDays()
    {
        if($this->type_project->observation_days_limit &&
            $this->type_project->re_entry_days_limit &&
            $this->type_project->final_status_days_limit){
            
                return true;
        }else{
            return false;
        }
    }

    public function isDirectFinalEvaluation()
    {
        if(!$this->type_project->observation_days_limit &&
            !$this->type_project->re_entry_days_limit &&
            $this->type_project->final_status_days_limit){
            
                return true;
        }else{
            return false;
        }
    }

    public function isNotRegisteredLimitDays()
    {
        if(!$this->type_project->observation_days_limit &&
        !$this->type_project->re_entry_days_limit &&
        !$this->type_project->final_status_days_limit){
        
            return true;
        }else{
            return false;
        }
    }
    
}
