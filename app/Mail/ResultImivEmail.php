<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResultImivEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $proyecto;
    public $tipo_calculo;
    public $texto_datos;
    public $entradas ='';
    public $salidas ='';
    public $sumatoria;
    public $suma_otros;
    public $maximo_t_privado;
    public $maximo_t_otros;
    public $estudio_t_privado;
    public $estudio_t_otros;
    
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct($request)
    {
        $this->tipo_calculo = $request->tipo_calculo;
        $this->texto_datos = $request->texto_datos;
        $this->sumatoria = json_decode($request->sumatoria);
        $this->suma_otros = json_decode($request->suma_otros);
        $this->maximo_t_privado = $request->maximo_t_privado;
        $this->maximo_t_otros = $request->maximo_t_otros;
        $this->estudio_t_privado = json_decode($request->estudio_t_privado);
        $this->estudio_t_otros = json_decode($request->estudio_t_otros);
        $this->proyecto = $request->proyecto;

        if($request->tipo_calculo != 'mixto'){
         $this->entradas = json_decode($request->entradas);
         $this->salidas = json_decode($request->salidas);
       }else{
        $this->proyecto = json_decode($request->proyecto);
        $this->texto_datos = json_decode($request->texto_datos);
       } 

       
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        if($this->tipo_calculo == 'mixto'){
            return $this->subject('Calculo IMIV e Intersecciones de proyecto MIXTO')
                    ->view('emails.mixtos');
        }
        if($this->proyecto == 'casas' || $this->proyecto == 'departamentos'){
            return $this->subject('Calculo IMIV e Intersecciones de tipo proyecto '.strtoupper($this->proyecto))
                        ->view('emails.casa_deptos');
        }else{
            return $this->subject('Calculo IMIV e Intersecciones de tipo proyecto '.strtoupper($this->proyecto))
                        ->view('emails.otros');
        }
    }
}
