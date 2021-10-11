<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//FormRequest
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    public function index()
    {
        $title_section = [
            'title' => 'Usuarios',
            'description' => '', 
        ];

        $button_create = [
            'title' => 'Usuario',
            'href' => route('admin.users.create'),
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Usuarios', 'active' => true],
        ]);

        return view('dashboard.admin.users.index')
            ->with('breadcrumbs', $breadcrumbs)
            ->with('title_section', $title_section)
            ->with('button_create', $button_create)
            ->with('users', User::all());
    }


    public function create()
    {
        $title_section = [
            'title' => 'Nuevo Usuario',
            'description' => 'Ingrese los datos necesarios para la creacion de un nuevo usuario.', 
        ];

        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Usuarios', 'href' => route('admin.users.index')],
            ['title' => 'Crear Usuario', 'active' => true]
        ]);

        return view('dashboard.admin.users.create')
            ->with('title_section', $title_section)
            ->with('breadcrumbs', $breadcrumbs);
    }


    public function store(UserRequest $request)
    {
        $user = User::storeUser($request);
        return redirect()->route('admin.users.index');
    }



    public function show(User $user)
    {
        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Usuarios', 'href' => route('admin.users.index')],
            ['title' => 'Ficha Usuario', 'active' => true]
        ]);

        return view('dashboard.admin.users.show')
            ->with('breadcrumbs', $breadcrumbs)
            ->with('user', $user);
    }


    public function edit($id)
    {
        
        $user = User::find($id);
        $breadcrumbs = collect([
            ['title' => 'home', 'href' => route('home')],
            ['title' => 'Lista Usuarios', 'href' => route('admin.users.index')],
            ['title' => 'Editar Usuario', 'active' => true]
        ]);

        $title_section = [
            'title' => 'Editar Usuario',
            'description' => 'Ingrese o Actualize los datos del usuario.', 
        ];

        return view('dashboard.admin.users.edit')
            ->with('breadcrumbs', $breadcrumbs)
            ->with('title_section', $title_section)
            ->with('user', $user);
    }


    public function update(UserRequest $request, $id)
    {
       
        $user_update = User::updateUser($request,$id);
        return redirect()->route('admin.users.index');
    }


    public function destroy($id)
    {
        $user_destroy = User::destroyUser($id);
        return redirect()->route('admin.users.index');
    }
}
