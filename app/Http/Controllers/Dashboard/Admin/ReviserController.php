<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reviser;
use Illuminate\Http\Request;

use App\Http\Requests\ReviserRequest;

class ReviserController extends Controller
{

    public function index()
    {
        $title_section = [
            'title' => 'Entidades Revisoras',
            'description' => '', 
        ];

        $button_create = [
            'title' => 'Revisor',
            'href' => route('admin.revisers.create'),
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Revisores', 'active' => true],
        ]);

        return view('dashboard.admin.revisers.index')
            ->with('title_section',$title_section)
            ->with('button_create',$button_create)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('revisers', Reviser::all());
    }

    public function create()
    {
        $title_section = [
            'title' => 'Nuevo Revisor',
            'description' => 'Ingrese los datos necesarios para la creacion de un nuevo revisor.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Revisores', 'href' => route('admin.revisers.index')],
            ['title' => 'Crear Revisor', 'active' => true]
        ]);

        return view('dashboard.admin.revisers.create')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs);
    }


    public function store(ReviserRequest $request)
    {
        $reviser = Reviser::storeReviser($request);
        return redirect()->route('admin.revisers.index');
    }


    public function show(ReviserRequest $revisore)
    {
        return view('dashboard.admin.revisers.show')->with('reviser', $revisore);
    }


    public function edit(Reviser $revisore)
    {
        $title_section = [
            'title' => 'Editar Revisor',
            'description' => 'Cambie los datos necesarios para actualizar al revisor.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Revisores', 'href' => route('admin.revisers.index')],
            ['title' => 'Editar Revisor', 'active' => true]
        ]);

        return view('dashboard.admin.revisers.edit')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('reviser', $revisore);
    }


    public function update(ReviserRequest $request, Reviser $revisore)
    {
        $reviser = Reviser::updateReviser($request, $revisore);
        return redirect()->route('admin.revisers.index');
    }

 
    public function destroy(Reviser $revisore)
    {
        $reviser_delete = Reviser:: destroyReviser($revisore);
        return redirect()->route('admin.revisers.index');
    }
}
