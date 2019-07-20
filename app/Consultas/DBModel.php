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

    public function getPersonData($id){
        $sql = "SELECT nombre, ap_paterno, ap_materno FROM persona WHERE id='$id'";
        $result = DB::select($sql);
        if($result){
            return $result;
        } else {
            return false;
        }
    }

    public function isStudent($personaID){
        $sql = "SELECT * from alumno where activo=1 and fk_id_persona='$personaID'";
        $result = DB::select($sql);
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function isEmployee($personaID){
       $sql = "SELECT * from personal where activo=1 and fk_id_persona='$personaID'";
        $result = DB::select($sql);
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public function getNombre($personaID){
        $sql = "SELECT nom, app, apm from persona where activo=1 and id='$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = $result[0]->nom.' '.$result[0]->app.' '.$result[0]->apm;
            return trim($res);
        } else {
             return 'Registro no encontrado';
        }
    }

    public function getCurp($personaID){
        $sql = "SELECT curp from persona where activo=1 and id='$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->curp) ? 'Sin Capturar la Curp' : $result[0]->curp);
            return $res;
        } else {
             return 'Registro no encontrado';
        }
    }

    public function getNoControl($personaID){
        $sql = "SELECT nocontrol from alumno where activo=1 and fk_id_persona='$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->nocontrol) ? 'Sin Capturar el NoControl' : $result[0]->nocontrol);
            return $res;
        } else {
            return 'Numero de Control no encontrado';
        }
    }

    public function getCarrera($personaID){
        $sql = "SELECT c.nombre FROM alumno as a, tecnologico_plan as tp, plan as p, carrera as c WHERE c.id=p.fk_id_carrera and p.id=tp.fk_id_plan and tp.id=a.fk_id_tecnologicoplan and a.fk_id_persona='$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->nombre) ? 'Sin Capturar nombre de Carrera' : $result[0]->nombre);
            return $res;
        } else {
            return 'Carrera no encontrada';
        }
    }

    public function getPeriodo($personaID){
        $sql = "SELECT p.nombre FROM alumno as a, periodo as p  WHERE p.id=a.fk_id_periodoingreso and a.fk_id_persona='$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->nombre) ? 'Sin Capturar nombre de Periodo' : $result[0]->nombre);
            return $res;
        } else {
            return 'Periodo no encontrado';
        }
    }

    public function getSemestre($personaID){
        return '7';
    }

    public function getPromedio($personaID){
       $sql = "SELECT a.promedio FROM alumno as a WHERE a.fk_id_persona='$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->promedio) ? 'Sin Capturar' : $result[0]->promedio);
            return $res;
        } else {
            return 'Promedio no encontrado';
        }
    }

    public function getEspecialidad($personaID){
        return 'Sistemas Distribuidos';
    }

    public function getRFC($personaID){
        return 'VIMR880822SX7';
    }

    public function getDepto($personaID){
        return 'Centro de Cómputo';
    }

    public function getOficina($personaID){
        return 'Coordinación de Desarrollo de Software';
    }

    public function getIngreso($personaID){
        return '1 de Junio de 2014';
    }

    public function getPlaza($personaID){
        return 'A08 - Secretaria Bilingue/110071456A0800300.0000103';
    }

    public function getPuesto($personaID){
        return 'Programador';
    }

}
?>