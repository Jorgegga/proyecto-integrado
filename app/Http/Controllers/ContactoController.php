<?php

namespace App\Http\Controllers;

use App\Mail\FormularioAdd;
use App\Mail\FormularioContacto;
use App\Mail\FormularioDelete;
use App\Mail\FormularioEmpresa;
use App\Mail\FormularioOtros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{

    public function formAdd()
    {

        $mensaje = request()->validate([
            'options'=> 'required',
            'titulo' => 'required',
            'correo' => 'required|email',
            'autor' => 'required',
        ],
        [
            'titulo.required' => __('Necesito un título'),
            'correo.required' => __('Hay que poner un correo'),
            'autor.required' => __('Necesito el nombre del autor'),
        ]);

        Mail::to('jorgegga.pruebas@gmail.com')->send(new FormularioAdd($mensaje));

        return redirect()->back();
    }

    public function formDelete()
    {

        $mensaje = request()->validate([
            'options'=> 'required',
            'titulo' => 'required',
            'correo' => 'required|email',
            'autor' => 'required',
            'mensaje' => 'required|min:5'
        ],
        [
            'titulo.required' => __('Necesito un titulo'),
            'autor.required' => __('Necesito el nombre del autor'),
            'correo.required' => __('Hay que poner un correo'),

        ]);

        Mail::to('jorgegga.pruebas@gmail.com')->send(new FormularioDelete($mensaje));

        return redirect()->back();
    }

    public function formNegocios()
    {

        $mensaje = request()->validate([
            'titulo' => 'required',
            'correo' => 'required|email',
            'mensaje' => 'required|min:5'
        ],
        [
            'titulo.required' => __('Necesito un titulo de la empresa'),
            'correo.required' => __('Hay que poner un correo'),
            'mensaje.required' => __('Necesito una descripción')
        ]);

        Mail::to('jorgegga.pruebas@gmail.com')->send(new FormularioEmpresa($mensaje));

        return redirect()->back();
    }

    public function formOtros()
    {
        $mensaje = request()->validate([
            'titulo' => 'required',
            'correo' => 'required|email',
            'mensaje' => 'required|min:5'
        ],
        [
            'titulo.required' => __('Es necesario poner un titulo'),
            'mensaje.required' =>__('Hay que poner una descripcion')
        ]);

        Mail::to('jorgegga.pruebas@gmail.com')->send(new FormularioOtros($mensaje));

        return redirect()->back();
    }
}
