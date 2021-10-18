<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Project;
use App\Models\TypeProject;
use App\Models\Customer;
use App\Models\Commune;
use Carbon\Carbon;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $title_section = [
            'title' => 'Proyectos',
            'description' => '', 
        ];

        $button_create = [
            'title' => ' / Ingresar Proyecto',
            'href' => route('admin.projects.create'),
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'active' => true],
        ]);
        $now = Carbon::now()->format('Y-m-d');
        
        //proyectos por reingresar - no vencidos
        $projects_for_reentry = Project::where('limit_re_entry_date', '>=', $now )
            ->whereNull('re_entry_date')
            ->orderBy('limit_re_entry_date', 'asc')->get(); 
        
        //proyectos por reingresar - vencidos   
        $projects_expired_reentry = Project::where('limit_re_entry_date', '<', $now )
            ->whereNull('re_entry_date')
            ->orderBy('limit_re_entry_date', 'desc')->get();

        //proyectos reingresados 
        $projects_reentry = Project::whereNotNull('re_entry_date')
            ->orderBy('limit_re_entry_date', 'desc')->get();
        
        //concatenacion de proyectos
        $fullProjects_tmp = $projects_expired_reentry->merge($projects_for_reentry);
        $fullProjects = $fullProjects_tmp->merge($projects_reentry);

        return view('dashboard.admin.projects.index')
            ->with('title_section',$title_section)
            ->with('button_create',$button_create)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('now',$now)
            ->with('projects', $fullProjects);

    }


    public function create()
    {
        $title_section = [
            'title' => 'Ingreso Nuevo Proyecto',
            'description' => 'Ingrese los datos necesarios para el ingreso de un nuevo proyecto.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Crear Proyecto', 'active' => true]
        ]);

        return view('dashboard.admin.projects.create')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('communes', Commune::all())
            ->with('type_projects', TypeProject::all())
            ->with('customers', Customer::all());
    }


    public function store(ProjectStoreRequest $request)
    {
        $project = Project::createProject($request);
        return redirect()->route('admin.projects.index');
    }


    public function show(Project $proyecto)
    {
        $title_section = [
            'title' => 'Ficha Proyecto',
            'description' => 'Detalle de toda la informacion del proyecto.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Ficha Proyecto', 'active' => true]
        ]);

        return view('dashboard.admin.projects.show')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('project', $proyecto);
    }


    public function edit(Project $proyecto)
    {
        $title_section = [
            'title' => 'Editar Proyecto',
            'description' => 'Cambie los datos necesarios para actualizar el proyecto.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Editar Proyecto', 'active' => true]
        ]);

        return view('dashboard.admin.projects.edit')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('communes', Commune::all())
            ->with('type_projects', TypeProject::all())
            ->with('customers', Customer::all())
            ->with('project', $proyecto);
    }


    public function update(ProjectUpdateRequest $request, Project $proyecto)
    {
        $project_update = Project::updateProject($request, $proyecto);
        return redirect()->route('admin.projects.index');
    }


    public function destroy(Project $proyecto)
    {
        $project_delete = Project::destroyProject($proyecto);
        return redirect()->route('admin.projects.index');
    }

    public function soonExpire()
    {
        $title_section = [
            'title' => 'Proyectos por Vencer Re-Ingreso',
            'description' => '', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Por Vencer Re-Ingreso', 'active' => true],
        ]);

        $projects = Project::all()->filter(function ($value, $key) {
            $ahora = now();
            $limite = Carbon::parse($value->limit_re_entry_date);
            if($limite >= now() && $ahora->diffInDays($limite) <= 2 && !isset($value->re_entry_date)){
                return $value; 
            }});

        return view('dashboard.admin.projects.soonExpire')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('projects', $projects);
    }


    public function expired()
    {
        $title_section = [
            'title' => 'Proyectos Vencidos en Re-Ingreso',
            'description' => '', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Vencidos', 'active' => true],
        ]);

        $projects = Project::all()->filter(function ($value, $key) {
            
            if($value->limit_re_entry_date < now() && !isset($value->re_entry_date)){
                return $value; 
            }});

        return view('dashboard.admin.projects.expired')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('projects', $projects);
    }


    public function editStatus(Project $proyecto)
    {
        $title_section = [
            'title' => 'Editar Estado Proyecto',
            'description' => '.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Editar Estado Proyecto #'.$proyecto->code , 'active' => true]
        ]);

        return view('dashboard.admin.projects.changeStatus')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('project', $proyecto);
    }


    public function updateStatus(Request $request, Project $proyecto)
    {
        $updateStatus = Project::statusUpdate($request, $proyecto);
        return redirect()->route('admin.projects.index');
        
    }


    public function editReEntry(Project $proyecto)
    {
        $title_section = [
            'title' => 'Re-Ingreso de Proyecto #'.$proyecto->code,
            'description' => '.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Re-Ingreso Proyecto #'.$proyecto->code , 'active' => true]
        ]);

        return view('dashboard.admin.projects.reEntry')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('project', $proyecto);
    }


    public function updateReEntry(Request $request, Project $proyecto)
    {
        $updateReEntry = Project::reEntryUpdate($request, $proyecto);
        return redirect()->route('admin.projects.index');
    }




}
