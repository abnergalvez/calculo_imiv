<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\TypeProject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TypeProjectRequest;

class TypeProjectController extends Controller
{

    public function index()
    {
        $title_section = [
            'title' => 'Tipos de Proyectos',
            'description' => '', 
        ];

        $button_create = [
            'title' => 'Tipo Proyecto',
            'href' => route('admin.type_projects.create'),
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Tipos de Proyectos', 'active' => true],
        ]);

        return view('dashboard.admin.type_projects.index')
            ->with('title_section',$title_section)
            ->with('button_create',$button_create)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('type_projects', TypeProject::all());
    }


    public function create()
    {
        $title_section = [
            'title' => 'Nuevo Tipo de Proyecto',
            'description' => 'Ingrese los datos necesarios para la creacion de un nuevo tipo de proyecto.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Tipos de Proyecto', 'href' => route('admin.type_projects.index')],
            ['title' => 'Crear Tipo Proyecto', 'active' => true]
        ]);

        return view('dashboard.admin.type_projects.create')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs);
    }


    public function store(TypeProjectRequest $request)
    {
        $type_project = TypeProject::storeTypeProject($request);
        return redirect()->route('admin.type_projects.index');
    }


    public function show(TypeProject $tipos_proyecto)
    {
        return view('dashboard.admin.type_projects.show')
            ->with('type_project', $tipos_proyecto);
    }


    public function edit(TypeProject $tipos_proyecto)
    {
        $title_section = [
            'title' => 'Editar Tipo de Proyecto',
            'description' => 'Ingrese o cambie los datos necesarios para actualizar tipo de proyecto.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Tipos de Proyecto', 'href' => route('admin.type_projects.index')],
            ['title' => 'Editar Tipo Proyecto', 'active' => true]
        ]);

        return view('dashboard.admin.type_projects.edit')
            ->with('title_section', $title_section)
            ->with('breadcrumbs', $breadcrumbs)    
            ->with('type_project', $tipos_proyecto);
    }


    public function update(TypeProjectRequest $request, TypeProject $tipos_proyecto)
    {
        $tipos_proyecto_update = TypeProject::updateTypeProject($request, $tipos_proyecto);
        return redirect()->route('admin.type_projects.index');
    }


    public function destroy(TypeProject $tipos_proyecto)
    {
        $type_project_delete = TypeProject::destroyTypeProject($tipos_proyecto);
        return redirect()->route('admin.type_projects.index');
    }
}
