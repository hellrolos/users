<?php

namespace App\Http\Controllers;
use App\Consultas\DBModel;
use App\Mail\MessageReceived;
use App\Mail\MessageSent;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;

class PasswordsController extends Controller
{
    protected $consultas;

	public function __construct(DBModel $model){
		$this->consultas = $model;
		$this->middleware('guest');
	}

	public function showForm(){
    	return view('passform');
    }

    public function sendResetLink(Request $request){
    	//aqui recivo el correo, lo valido, genero el token, guardo el registro en la base de datos y envio el correo
    	$user = $request->input('nocontrol');
    	$correo = $request->input('correo');
    	$validar =  Validator::make($request->all(), [
            'correo' => 'required|string|email',
            'nocontrol' => 'required'
        ]);
        if($validar->fails()){
        	return back()->with(['alert' => 'Introduzca los valores de manera correcta.']);
        }
        else{
        	$ValidaAlumno = Validator::Make(['user' => $user], ['user' => 'numeric']);
        	$ValidaDocente = Validator::Make(['user' => $user],['user' => ['regex:/^(([ÑA-Z|ña-z|&]{3}|[A-Z|a-z]{4})\d{2}((0[1-9]|1[012])(0[1-9]|1\d|2[0-8])|(0[13456789]|1[012])(29|30)|(0[13578]|1[02])31)(\w{2})([A|a|0-9]{1}))$|^(([ÑA-Z|ña-z|&]{3}|[A-Z|a-z]{4})([02468][048]|[13579][26])0229)(\w{2})([A|a|0-9]{1})$/']]);
        	if($ValidaAlumno->fails()){
        		if($ValidaDocente->fails()){
        			dd('fallo en la validacion de ambos');
        			return back()->with(['alert' => 'Introduzca los valores de manera correcta.']);
        		}
        		else{
        			$IdPerUsuario = $this->consultas->getPersona($correo);
        			$IdPerTrabajador = $this->consultas->getTrabajador($user);
        			if($IdPerUsuario == $IdPerTrabajador)
        			{
        				$token = $this->consultas->createToken($correo);
        				//dd($token);
        				//envía correo en esta seccion lo cual queda pendiente
        				/*Mail::to($correo)->queue(new MessageSent($token));*/
        				return new MessageSent($token);
        				return back()->with(['alert' => 'Se ha enviado un correo con el link para el cambio de contraseña']);
        			} else {
        				return back()->with(['alert' => 'Introduzca los valores de manera correcta.']);
        			}
        		}
        	}
        	else
        	{
        		$IdPerUsuario = $this->consultas->getPersona($correo);
        		$IdPerAlumno = $this->consultas->getAlumno($user);
        		if($IdPerUsuario == $IdPerAlumno){
        			$token = $this->consultas->createToken($correo);
        			dd($token);
        			//envía correo en esta seccion lo cual queda pendiente
        			return back()->with(['alert' => 'Se ha enviado un correo con el link para el cambio de contraseña']);
        		} else {
        			return back()->with(['alert' => 'Introduzca los valores de manera correcta.']);
        		}
        	}
        }
    }

    public function showResetForm($token){
    	//valida si existe el token y el correo en la tabla password_reset
    	if($this->consultas->getTokenExist($token)){
    		$row = $this->consultas->getTokenData($token);
    		$today = Carbon::now();
    		$tokenDay = Carbon::create($row[0]->created_at);
    		$DifHours = $tokenDay->diffInHours($today);
    		if($DifHours > 48)
    		{
    			return redirect('password-reset')->with(['alert' => 'Ha expirado su solicitud de cambio de contraseña, relice otra petición por favor.']);
    		}
    		$data = [
    			'token' => $token,
    			'email' => $row[0]->email,
    			'time' => $DifHours.' hrs.',
    		];
    		return view('resetform', compact('data'));
    	}
    	else
    	{
    		return 'No es un token valido';
    	}
    }

    public function resetPassword(Request $request){
    	$token = $request->input('token');
    	$newpass = $request->input('pass1');
    	$reppass = $request->input('reppass');
    	if($this->consultas->getTokenExist($token)){
	    	$row = $this->consultas->getTokenData($token);
	    	$today = Carbon::now();
	    	$tokenDay = Carbon::create($row[0]->created_at);
	 	  	$DifHours = $tokenDay->diffInHours($today);
	 	  	$email = $row[0]->email;
	 	  	if($DifHours > 48){
	 	  		return redirect('password-reset')->with(['alert' => 'La solicitud de restauración de contraseña ha expirado']);
	 	  	} else {
	 	  		if($newpass == $reppass){
	 	  			$this->consultas->updateProfile($email, $newpass);
	 	  			return redirect('/')->with(['alert' => 'La contraseña ha sido actulizada, por favor inicia sesión para que se active tu cuenta']);
	 	  		} else {
	 	  			return back()->with(['alert' => 'Las contraseñas no coinciden']);
	 	  		}
	 	  	}
	 	} else {
	 		return redirect('/')->with(['alert' => 'La solicitud de restauración de contraseña ha expirado - 403 - Forbidden']);
	 	}
    }
}
