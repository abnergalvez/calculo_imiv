<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Casas;
use App\Models\Departamentos;
use App\Models\HogaresAcogida;
use App\Models\Cientifico;
use App\Models\Comercio;
use App\Models\CultoCultura;
use App\Models\Deporte;
use App\Models\Educacion;
use App\Models\Esparcimiento;
use App\Models\Hospedaje;
use App\Models\Industrial;
use App\Models\Salud;
use App\Models\Servicios;
use App\Models\Social;


class HomeController extends Controller
{
    public function index()
    {
        
        return view('inicio')
            ->with('proyectos', $this->fullProyectos());
    }

    public function fullProyectos()
    {
        $proyectos = [
            'casas' => ['label' => 'Casas','modelo' => Casas::class],
            'departamentos' => ['label' => 'Departamentos','modelo' => Departamentos::class],
            'c_acogida' => ['label' => 'Hogares de Acogida','modelo' => HogaresAcogida::class],
            'cientifico' => ['label' => 'Cientifico','modelo' => Cientifico::class],
            'comercio' => ['label' => 'Comercio','modelo' => Comercio::class],
            'culto_y_cultura' => ['label' => 'Culto y Cultura','modelo' => CultoCultura::class],
            'deporte' => ['label' => 'Deporte','modelo' => Deporte::class],
            'educacion' => ['label' => 'Educacion','modelo' => Educacion::class],
            'esparcimiento' => ['label' => 'Esparcimiento','modelo' => Esparcimiento::class],
            'hospedaje' => ['label' => 'Hospedaje','modelo' => Hospedaje::class],
            'industrial' => ['label' => 'Industrial','modelo' => Industrial::class],
            'salud' => ['label' => 'Salud','modelo' => Salud::class],
            'servicios' => ['label' => 'Servicios','modelo' => Servicios::class],
            'social' => ['label' => 'Social','modelo' => Social::class],
            ];

        return $proyectos;
    }
}

