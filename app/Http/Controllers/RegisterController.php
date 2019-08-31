<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showForm(){
    	//Muestra el formulario
    	return view('register');
    }

    public function sendInfo(){
    	//Guarda info en la bd y llama la funcion showrecord a traves del get
    }

    public function showRecord($token){
    	//Muestra una pagina donde se notifica que se llevo acabo el registro, con datos sobre el monto a pagar, lugar y fecha limite junto a fecha inscripcion
    	return view('record');
    }

    public function showPDFRecord($token){
    	return view('registerpdf');
    	//La misma info de showRecord pero lo muestre en un PDF
    }
}
