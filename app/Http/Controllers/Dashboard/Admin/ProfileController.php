<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\User;

//FormRequest
use App\Http\Requests\UserRequest;

class ProfileController extends Controller
{
    public function index()
    {

        $title_section = [
            'title' => 'Home',
            'description' => '', 
        ];
       
        $date = Carbon::now()->locale('es_ES');
        
        $actual = ucfirst($date->isoFormat('MMM D'));

        $projects['total'] = \App\Models\Project::all();
        $projects['actual'] = \App\Models\Project::whereMonth('entry_date', date('m'))->whereYear('entry_date', date('Y'))->get(['name','entry_date']);
        $projects['inicial'] = ucfirst(Carbon::parse($projects['total']->min('entry_date'))->isoFormat('MMM D'));
        $projects['final'] = ucfirst(Carbon::parse($projects['total']->max('entry_date'))->isoFormat('MMM D'));

        $customers['total'] = \App\Models\Customer::all();
        $customers['actual'] = \App\Models\Customer::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get(['name','created_at']);
        $customers['inicial'] = ucfirst(Carbon::parse($customers['total']->min('created_at'))->isoFormat('MMM D'));
        $customers['final'] = ucfirst(Carbon::parse($customers['total']->max('created_at'))->isoFormat('MMM D'));

        $users['total'] = \App\Models\User::all();
        $users['actual'] = \App\Models\User::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get(['name','created_at']);
        $users['inicial'] = ucfirst(Carbon::parse($users['total']->min('created_at'))->isoFormat('MMM D'));
        $users['final'] = ucfirst(Carbon::parse($users['total']->max('created_at'))->isoFormat('MMM D'));

        $status = \DB::table('projects')->selectRaw('status, count(*) as cant')->where('status', '!=', NULL)->groupBy('status')->get();
        $statusCountNull = \DB::table('projects')->where('status', null)->count();

        $types = \App\Models\TypeProject::all();

        $types_filter = $types->filter(function ($value, $key) {
            
            if(count($value->projects) > 0){
                return $value; 
            }
        });

        $customersGrap = \App\Models\Customer::all();

        $customers_filter = $customersGrap->filter(function ($value, $key) {
            
            if(count($value->projects) > 0){
                return $value; 
            }
        });
        $projectSoonExpired = $projects['total']->filter(function ($value, $key) {
                $ahora = now();
                $limite = Carbon::parse($value->limit_re_entry_date);
                if($limite >= now() && $ahora->diffInDays($limite) <= 2 && !isset($value->re_entry_date)){
                    return $value; 
                }});
        
        $projectExpired = $projects['total']->filter(function ($value, $key) {
            
            if($value->limit_re_entry_date < now() && !isset($value->re_entry_date)){
                return $value; 
            }});
        
       

        return view('dashboard.admin.home')
            ->with('projectStats',$projects)
            ->with('customerStats',$customers)
            ->with('userStats',$users)
            ->with('now',$actual)
            ->with('status',$status)
            ->with('types',$types_filter)
            ->with('customers',$customers_filter)
            ->with('statusCountNull',$statusCountNull)
            ->with('projectSoonExpired',$projectSoonExpired)
            ->with('projectExpired',$projectExpired)
            ->with('title_section', $title_section);
    }

    public function profile()
    {
        
        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Mi Perfil & Datos', 'active' => true]
        ]);

        $title_section = [
            'title' => 'Mi Perfil & Datos',
            'description' => 'Aqui puedes ver y actualizar los datos de tu cuenta de usuario.', 
        ];

        return view('dashboard.admin.profile.index')
            ->with('breadcrumbs', $breadcrumbs)
            ->with('title_section', $title_section)
            ->with('user', Auth::user());
    }

    public function update(UserRequest $request)
    {
        $user_update = User::updateUser( $request, $request->id);
        return redirect()->route('admin.profile');
    }
}
