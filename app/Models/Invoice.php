<?php

namespace App\Models;
use App\Models\Project;
use Carbon\Carbon;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'number',
        'status',
        'accepted_date',
        'doc_path',
        'project_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public static function storeInvoice($request, $project)
    {
        if($request->accepted_date){
            $newDate = Carbon::createFromFormat('d-m-Y', $request->accepted_date);
            $request->request->remove('accepted_date');
            $request->request->add(['accepted_date' => $newDate->format('Y-m-d')]);
        }
        $request->request->add(['project_id' => $project->id ]);

        $invoice = Invoice::create($request->all());

        $dir = 'public/project/'.$project->id.'/invoices';

        if ($request->hasFile('doc')){
            
            $file = $request->doc;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            $invoice->doc_path = $path;
            $invoice->save();
        }

        if($invoice){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "La factura se ha ingresado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para ingresar la factura",
            );
            request()->session()->put('status', $status);
        }
        
        return $invoice;
    }

    public static function updateInvoice($request, $project, $invoice)
    {
        $dir = 'public/project/'.$project->id.'/invoices';

        if ($request->hasFile('doc')){
            
            if($invoice->doc_path){
                Storage::delete($invoice->doc_path);
            }

            $file = $request->doc;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            $request->request->add(['doc_path'=> $path]);
        }

        if($request->accepted_date){
            $newDate = Carbon::createFromFormat('d-m-Y', $request->accepted_date);
            $request->request->remove('accepted_date');
            $request->request->add(['accepted_date' => $newDate->format('Y-m-d')]);
        }else{
            $request->request->add(['accepted_date' => NULL]);
        }

        $invoice_update = $invoice->update($request->all());

        if($invoice_update){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "La factura se ha actualizado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para actualizar la factura",
            );
            request()->session()->put('status', $status);
        }
       
        return $invoice_update;
    }

    public static function destroyInvoice($project, $invoice)
    {
        if($invoice->doc_path){
            Storage::delete($invoice->doc_path);
        }
        
        $invoice_delete = $invoice->delete();

        if($invoice_delete){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "La factura se ha eliminado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para eliminar la factura",
            );
            request()->session()->put('status', $status);
        }

        return $invoice_delete;
    }

    public static function statusUpdate($request, $invoice)
    {
        $invoice->status = $request->status;
        $invoiceUpdateStatus = $invoice->save();
        if($invoiceUpdateStatus){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El estado de la factura se ha actualizado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para actualizar el estado de la factura",
            );
            request()->session()->put('status', $status);
        }

        return $invoiceUpdateStatus;
    }

    public function statusLabels()
    {
        $status = [
            'accepted' => ['label'=> 'Aceptada', 'class' =>'info'] ,
            'rejected' => ['label'=> 'Rechazada','class' =>'danger'],
            'to_pay' => ['label'=> 'Por Pagar','class' =>'warning'],
            'paid' => ['label'=> 'Pagada','class' =>'success']
        ];

        return $status[$this->status];
    }

}
