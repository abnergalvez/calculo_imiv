<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\Commune;
use App\Models\TypeProject;
use App\Models\Customer;
use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\BudgetStoreRequest;
use App\Http\Requests\BudgetUpdateRequest;

class BudgetController extends Controller
{

    public function index()
    {
        $title_section = [
            'title' => 'Presupuestos',
            'description' => '', 
        ];

        $button_create = [
            'title' => ' Presupuesto',
            'href' => route('admin.budgets.create'),
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Presupuestos', 'active' => true],
        ]);


        return view('dashboard.admin.budgets.index')
            ->with('title_section',$title_section)
            ->with('button_create',$button_create)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('budgets', Budget::all());
    }


    public function create()
    {
        $title_section = [
            'title' => 'Nuevo Presupuesto',
            'description' => 'Ingrese los datos necesarios para el ingreso de un nuevo presupuesto.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Presupuestos', 'href' => route('admin.budgets.index')],
            ['title' => 'Crear Presupuesto', 'active' => true]
        ]);
        $project_used = implode(', ', array_column(\DB::table('budgets')->select('project_id')->get()->toArray(),'project_id'));
        
        return view('dashboard.admin.budgets.create')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('communes', Commune::all())
            ->with('type_projects', TypeProject::all())
            ->with('projects', Project::whereNotIn('id',[$project_used])->get())
            ->with('customers', Customer::all());
    }

    public function store(BudgetStoreRequest $request)
    {

        if($request->create_option == 'budget_project_create'){
            $request_project = $request->only(['name', 'customer_id','code','type_project_id','code_number']);
            $request_project['status'] = 'in_budget';
            $project = Project::createProjectFromBudget($request_project);
        
            $request->request->add(['project_id' => $project->id]);
            $request_budget = $request->only(['number', 'amount','status','doc', 'accepted_date','entry_date','project_id']);
            $budget = Budget::storeBudget(collect($request_budget));
        }else{
            
            $request_budget = $request->only(['number', 'amount','status','doc', 'accepted_date','entry_date','project_id']);
            $budget = Budget::storeBudget(collect($request_budget));
        }

        return redirect()->route('admin.budgets.index');
    }


    public function show(Budget $presupuesto)
    {
        $title_section = [
            'title' => 'Ficha Presupuesto',
            'description' => 'Detalle de toda la informacion del presupuesto.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Presupuestos', 'href' => route('admin.budgets.index')],
            ['title' => 'Ficha de Presupuesto', 'active' => true]
        ]);

        return view('dashboard.admin.budgets.show')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('budget', $presupuesto);
    }


    public function edit(Budget $presupuesto)
    {
        $title_section = [
            'title' => 'Editar Presupuesto - Proyecto '.$presupuesto->project->code,
            'description' => 'Cambie los datos necesarios para actualizar el presupuesto.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Presupuestos', 'href' => route('admin.budgets.index')],
            ['title' => 'Editar Presupuesto', 'active' => true]
        ]);

        return view('dashboard.admin.budgets.edit')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('communes', Commune::all())
            ->with('type_projects', TypeProject::all())
            ->with('customers', Customer::all())
            ->with('budget', $presupuesto);
    }


    public function update(BudgetUpdateRequest $request, Budget $presupuesto)
    {
        $budget_update = Budget::updateBudget($request, $presupuesto);
        return redirect()->route('admin.budgets.index');
    }

 
    public function destroy(Budget $presupuesto)
    {
        $budget_delete = Budget::destroyBudget($presupuesto);
        return redirect()->route('admin.budgets.index');
    }

    public function editStatus(Budget $presupuesto)
    {
        $title_section = [
            'title' => 'Editar Estado Presupuesto',
            'description' => '.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Presupuestos', 'href' => route('admin.budgets.index')],
            ['title' => 'Editar Estado Presupuesto', 'active' => true]
        ]);

        return view('dashboard.admin.budgets.changeStatus')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('budget', $presupuesto);
    }

    public function updateStatus(Request $request, Budget $presupuesto)
    {
        $updateStatus = Budget::statusUpdate($request, $presupuesto);
        return redirect()->route('admin.budgets.index');
    }

    public function soonExpire()
    {
        $title_section = [
            'title' => 'Presupuestos por vencer Ingreso',
            'description' => '', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Presupuestos', 'href' => route('admin.budgets.index')],
            ['title' => 'Por Vencer Ingreso', 'active' => true],
        ]);

        $now = Carbon::today();

        $budgets = Budget::all()->filter(function ($value, $key) use ($now) {
            $limite = Carbon::parse($value->limit_entry_date);
            if($limite >= $now && $now->diffInDays($limite) <= 2 && !isset($value->entry_date)){
                return $value; 
            }});
            
        return view('dashboard.admin.budgets.index')
            ->with('title_section',$title_section)
            ->with('breadcrumbs',$breadcrumbs)
            ->with('now',$now)
            ->with('budgets', $budgets);
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

}
