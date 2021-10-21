<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{

    public function index()
    {
        $title_section = [
            'title' => 'Clientes',
            'description' => '', 
        ];

        $button_create = [
            'title' => 'Cliente',
            'href' => route('admin.customers.create'),
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Clientes', 'active' => true],
        ]);

        return view('dashboard.admin.customers.index')
            ->with('title_section',$title_section)
            ->with('button_create',$button_create)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('customers', Customer::all());
    }

    public function create()
    {
        $title_section = [
            'title' => 'Nuevo Cliente',
            'description' => 'Ingrese los datos necesarios para la creacion de un nuevo cliente.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Clientes', 'href' => route('admin.customers.index')],
            ['title' => 'Crear Cliente', 'active' => true]
        ]);

        return view('dashboard.admin.customers.create')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs);
    }


    public function store(CustomerRequest $request)
    {
        $customer = Customer::storeCustomer($request);
        return redirect()->route('admin.customers.index');
    }

 
    public function show(Customer $cliente)
    {
        return view('dashboard.admin.customers.show')->with('customer', $cliente);
    }


    public function edit(Customer $cliente)
    {   
        $title_section = [
            'title' => 'Editar Cliente',
            'description' => 'Cambie los datos necesarios para actualizar al cliente.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Clientes', 'href' => route('admin.customers.index')],
            ['title' => 'Editar Cliente', 'active' => true]
        ]);

        return view('dashboard.admin.customers.edit')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('customer', $cliente);
    }


    public function update(Request $request, Customer $cliente)
    {
        $customer = Customer::updateCustomer($request, $cliente);
        return redirect()->route('admin.customers.index');
    }


    public function destroy(Customer $cliente)
    {
        $customer_delete = Customer:: destroyCustomer($cliente);
        return redirect()->route('admin.customers.index');
    }
}
