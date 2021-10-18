<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Invoice;
use App\Models\Project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;

class InvoiceController extends Controller
{

    public function index(Project $proyecto)
    {
        $title_section = [
            'title' => 'Gestión Facturas',
            'description' => '', 
        ];

        $button_create = [
            'title' => ' / Ingresar Factura',
            'href' => route('admin.projects.invoices.create',$proyecto->id),
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Proyecto #'.$proyecto->code.' - Gestión Facturas ', 'active' => true],
        ]);

        $invoices = $proyecto->invoices;

        return view('dashboard.admin.invoices.index')
        ->with('title_section',$title_section)
        ->with('button_create',$button_create)
        ->with('breadcrumbs',$breadcrumbs)
        ->with('invoices', $invoices)
        ->with('project', $proyecto);

    }


    public function create(Project $proyecto)
    {
        $title_section = [
            'title' => 'Ingreso de Factura',
            'description' => 'Llena los campos necesarios para ingresar la factura', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Proyecto #'.$proyecto->code.' - Lista de Facturas ', 
            'href' => route('admin.projects.invoices.index', $proyecto->id)],
            ['title' => 'Ingreso de Factura', 'active' => true],
        ]);

        return view('dashboard.admin.invoices.create')
        ->with('title_section',$title_section)
        ->with('breadcrumbs',$breadcrumbs)
        ->with('project', $proyecto);
    }

 
    public function store(InvoiceRequest $request, Project $proyecto)
    {
        $invoice_store = Invoice::storeInvoice($request, $proyecto );
        return redirect()->route('admin.projects.invoices.index', $proyecto->id);
    }


    public function show(Project $proyecto, Invoice $factura)
    {
        $title_section = [
            'title' => 'Ficha de Factura',
            'description' => '', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Proyecto #'.$proyecto->code.' - Lista de Facturas ', 'href' => route('admin.projects.invoices.index',$proyecto->id )],
            ['title' => 'Ficha de Factura', 'active' => true],
        ]);

        return view('dashboard.admin.invoices.show')
        ->with('title_section',$title_section)
        ->with('breadcrumbs',$breadcrumbs)
        ->with('invoice', $factura)
        ->with('project', $proyecto);
    }


    public function edit(Project $proyecto, Invoice $factura)
    {
        $title_section = [
            'title' => 'Editar Factura',
            'description' => 'Cambie la información de la factura para actualizarla', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Proyecto #'.$proyecto->code.' - Lista de Facturas ', 'href' => route('admin.projects.invoices.index',$proyecto->id )],
            ['title' => 'Editar Factura', 'active' => true],
        ]);

        return view('dashboard.admin.invoices.edit')
        ->with('title_section',$title_section)
        ->with('breadcrumbs',$breadcrumbs)
        ->with('invoice', $factura)
        ->with('project', $proyecto);
    }


    public function update(InvoiceRequest $request, Project $proyecto, Invoice $factura)
    {
        $invoice_update = Invoice::updateInvoice($request, $proyecto, $factura);
        return redirect()->route('admin.projects.invoices.index', $proyecto->id);
    }

 
    public function destroy(Project $proyecto,Invoice $factura)
    {
        $invoice_destroy = Invoice::destroyInvoice($proyecto,$factura);
        return redirect()->route('admin.projects.invoices.index', $proyecto->id);
    }

    public function editStatus(Project $proyecto, Invoice $factura)
    {
        $title_section = [
            'title' => 'Editar Estado Factura',
            'description' => '.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Proyecto #'.$proyecto->code.' - Lista de Facturas ', 'href' => route('admin.projects.invoices.index',$proyecto->id )],
            ['title' => 'Editar Estado Factura', 'active' => true],
        ]);

        return view('dashboard.admin.invoices.changeStatus')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('project', $proyecto)
            ->with('invoice', $factura);
    }

    public function updateStatus(Request $request, Project $proyecto, Invoice $factura)
    {
        $updateStatus = Invoice::statusUpdate($request, $factura);
        return redirect()->route('admin.projects.invoices.index', $proyecto->id);  
    }
}
