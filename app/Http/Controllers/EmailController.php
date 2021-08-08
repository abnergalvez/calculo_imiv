<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Session;
use App\Models\FuncionesCalculos;
use App\Mail\ResultImivEmail;


class EmailController extends Controller
{
    public function enviarResultados(Request $request)
    {
        if($request->email){
            Mail::to($request->email)->send(new ResultImivEmail($request));
            return view('emails.respuesta');
        }
        return redirect()->back();
    }
}
