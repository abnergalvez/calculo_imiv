<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Project;
use App\Models\TypeProject;
use App\Models\Reviser;
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
        $now = Carbon::today();
        
        //proyectos por reingresar - no vencidos
        $projects_for_reentry = Project::where('re_entry_date', '>=', $now )
            ->where(function($q){
                $q->where('status', 'registered_for_observation')->orWhere('status','in_correction');
            })->orderBy('re_entry_date', 'asc')->get(); 
        
        //proyectos por reingresar - vencidos   
        $projects_expired_reentry = Project::where('re_entry_date', '<', $now )
            ->where(function($q){
                $q->where('status', 'registered_for_observation')->orWhere('status','in_correction');
            })->orderBy('re_entry_date', 'asc')->get();

        //proyectos reingresados 
        $projects_reentry = Project::where('re_entry_date', '<', $now )
            ->where(function($q){
                $q->where('status', 're_entered');
            })
            ->orderBy('limit_re_entry_date', 'asc')->get();

        //proyectos en Presupuesto    
        $projects_budgets = Project::where('status','in_budget')->orderBy('created_at', 'asc')->get();

        //proyectos Aceptados /Rechazados
        $projects_final_status = Project::where('re_entry_date', '<', $now )
        ->where(function($q){
            $q->where('status','accepted')
                ->orWhere('status','rejected');
        })
        ->orderBy('created_at', 'desc')->get();

        $p_for_reentry_ids = array_column($projects_for_reentry->toArray(),'id');
        $p_expired_reentry_ids = array_column($projects_expired_reentry->toArray(),'id');
        $p_reentry_ids = array_column($projects_reentry->toArray(),'id');
        $p_budget_ids = array_column($projects_budgets->toArray(),'id');
        $p_final_status_ids = array_column($projects_final_status->toArray(),'id');

        $merge_projects_ids = array_merge($p_for_reentry_ids,$p_expired_reentry_ids,$p_reentry_ids,$p_budget_ids,$p_final_status_ids);
        
        
        //demas proyectos
        $projects_entry = Project::whereNotIn('id',[implode(', ',$merge_projects_ids)])
            ->orderBy('created_at', 'asc')->get();

        //concatenacion de proyectos
        $fullProjects_tmp = $projects_expired_reentry->merge($projects_for_reentry);
        $fullProjects_tmp2 = $fullProjects_tmp->merge($projects_reentry);
        $fullProjects_tmp3 = $fullProjects_tmp2->merge($projects_entry);
        $fullProjects_tmp4 = $fullProjects_tmp3->merge($projects_budgets);
        $fullProjects = $fullProjects_tmp4->merge($projects_final_status);

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
            ->with('revisers', Reviser::all())
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
            ->with('revisers', Reviser::all())
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

    public function soonObservationExpire()
    {
        $title_section = [
            'title' => 'Proyectos por Vencer Observacion Entidad Revisora',
            'description' => '', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Por Vencer Observacion', 'active' => true],
        ]);

        $now = Carbon::today();

        $projects = Project::all()->filter(function ($value, $key) use ($now) {
            $limite = Carbon::parse($value->limit_observation_date);
            if($limite >= $now 
            && $now->diffInDays($limite) <= 3 
            && !isset($value->observation_date)
            && isset($value->limit_observation_date)){
                return $value; 
            }});
            
        return view('dashboard.admin.projects.index')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('now',$now)
            ->with('projects', $projects);
    }

    public function finalStatusSoonExpire()
    {
        $title_section = [
            'title' => 'Proyectos por vencer Estado Final Entidad Revisora',
            'description' => '', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Proyectos', 'href' => route('admin.projects.index')],
            ['title' => 'Por Vencer Estado Final', 'active' => true],
        ]);

        $now = Carbon::today();

        $projects = Project::all()->filter(function ($value, $key) use ($now) {
            $limite = Carbon::parse($value->limit_final_status_date);
            if($limite >= $now 
            && $now->diffInDays($limite) <= 3 
            && !isset($value->final_status_date)
            && isset($value->limit_final_status_date)){
                return $value; 
            }});
            
        return view('dashboard.admin.projects.index')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('now',$now)
            ->with('projects', $projects);
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

        $now = Carbon::today();

        $projects = Project::all()->filter(function ($value, $key) use ($now) {
            $limite = Carbon::parse($value->limit_re_entry_date);
            if($limite >= $now 
            && $now->diffInDays($limite) <= 3 
            && !isset($value->re_entry_date)
            && isset($value->limit_re_entry_date)){
                return $value; 
            }});
            
        return view('dashboard.admin.projects.index')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('now',$now)
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

        $now = Carbon::today();

        $projects = Project::all()->filter(function ($value, $key) use ($now) {
            
            if($value->limit_re_entry_date < $now && !isset($value->re_entry_date)){
                return $value; 
            }});

        return view('dashboard.admin.projects.index')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('now',$now)
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
