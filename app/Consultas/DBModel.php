<?php
namespace App\Consultas;
use DB;
use Carbon;
use App\User;
use Illuminate\Support\Facades\Hash;

class DBModel{
    public function getPersona($correo){
    	$sql = "SELECT fk_id_persona FROM user WHERE email='$correo'";
    	$result = DB::select($sql);
    	/*dd($result[0]->fk_id_persona);*/
    	if($result){
    		return $result[0]->fk_id_persona;
    	} else {
    		return 0;
    	}
    }

    public function getTrabajador($RFC){
    	$sql = "SELECT fk_id_persona FROM `personal` WHERE rfc = '$RFC'";
    	$result = DB::select($sql);
    	if($result){
    		return $result[0]->fk_id_persona;
    	} else {
    		return 0;
    	}
    }

    public function getAlumno($nocontrol){
    	$sql = "SELECT fk_id_persona FROM `alumno` WHERE nocontrol='$nocontrol'";
    	$result = DB::select($sql);
    	if($result){
    		return $result[0]->fk_id_persona;
    	} else {
    		return 0;
    	}
    }

    public function createToken($mail){
    	//valida si hay un registro previo, si es asi lo borra y crea el nuevo token
    	$sql = "SELECT email FROM password_reset where email='$mail'";
    	$result = DB::select($sql);
    	if($result){
    		DB::table('password_reset')->where('email', $mail)->delete();
    	}
    	DB::table('password_reset')->insert([
        'email' => $mail,
        'token' => str_random(60), //change 60 to any length you want
        'created_at' => Carbon::now()
    	]);
    	$tokenData = DB::table('password_reset')->where('email', $mail)->first();
    	return $tokenData;
    }

    public function getTokenExist($token){
    	//Valida que el token exista y retorna un verdadero en ese caso
    	$sql = "SELECT email FROM password_reset WHERE token='$token'";
    	$result = DB::select($sql);
    	if($result){
    		return true;
    	} else {
    		return false;
    	}
    }

    public function getTokenData($token){
    	//Consulta la información del token
    	$sql = "SELECT email, created_at FROM password_reset WHERE token='$token'";
    	$result = DB::select($sql);
    	if($result){
    		return $result;
    	} else {
    		return false;
    	}
    }

    public function updateProfile($correo, $password){
    	//buscar el usuario, actulizar el password de manera cifrada y luego guardar.
    	$user = User::where("email","=", $correo)->first();
    	$user->password = Hash::make($password);
    	$user->save();
    }
}
?>