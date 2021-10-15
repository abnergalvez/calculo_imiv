<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'rut',
        'prefix',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public static function storeCustomer($request)
    {
        $customer = Customer::create($request->all());

        if($customer){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El cliente se ha creado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para crear el cliente",
            );
            request()->session()->put('status', $status);
        }

        return $customer;
    }

    public static function updateCustomer($request, $customer)
    {
        
        if($customer->update($request->all())){
            
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El cliente se ha actualizado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para actualizar al cliente",
            );
            request()->session()->put('status', $status);
        }

        return $customer;
    }

    public static function destroyCustomer($customer)
    {
        $customer_delete = $customer->delete();
        if( $customer_delete ){
            
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El cliente se ha borrado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para borrar al cliente",
            );
            request()->session()->put('status', $status);
        }

        return $customer_delete;
    }
}
