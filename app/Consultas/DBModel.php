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
             return 'Registro de nombre no encontrado';
        }
    }

    public function getCurp($personaID){
        $sql = "SELECT curp from persona where activo=1 and id='$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->curp) ? 'Sin Capturar la Curp' : $result[0]->curp);
            return $res;
        } else {
             return 'Registro no CURP encontrado';
        }
    }

    public function getNoControl($personaID){
        $sql = "SELECT nocontrol from alumno where activo=1 and fk_id_persona='$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->nocontrol) ? 'Sin Capturar el NoControl' : $result[0]->nocontrol);
            return $res;
        } else {
            return 'Registro de Numero de Control no encontrado';
        }
    }

    public function getCarrera($personaID){
        $sql = "SELECT c.nombre FROM alumno as a, tecnologico_plan as tp, plan as p, carrera as c WHERE c.id=p.fk_id_carrera and p.id=tp.fk_id_plan and tp.id=a.fk_id_tecnologicoplan and a.fk_id_persona='$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->nombre) ? 'Sin Capturar nombre de Carrera' : $result[0]->nombre);
            return $res;
        } else {
            return 'Registro de Carrera no encontrada';
        }
    }

    public function getPeriodo($personaID){
        $sql = "SELECT p.nombre FROM alumno as a, periodo as p  WHERE p.id=a.fk_id_periodoingreso and a.fk_id_persona='$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->nombre) ? 'Sin Capturar nombre de Periodo' : $result[0]->nombre);
            return $res;
        } else {
            return 'Registro de Periodo no encontrado';
        }
    }

    public function getPeriodosAlumno($personaID){
        $sql = "SELECT p.clave as ingreso, p1.clave as salida FROM alumno as a LEFT JOIN periodo as p ON a.fk_id_periodoingreso=p.id LEFT JOIN periodo as p1 ON a.fk_id_periodosalida=p1.id WHERE a.fk_id_persona = '$personaID'";
        $result = DB::select($sql);
        if($result){
           return $result;
        } else {
            return 'Registro de Periodo no encontrado';
        }
    }

    public function getSemestre($personaID){
        $now = Carbon::now();
        if($now->month <= 6)
        {
            $pe = 1;
        } else {
            if($now->month >= 8){
                $pe = 3;
            } else {
                $pe = 2;
            }
        }
        $periodo = $now->year.$pe;
        $periodos = $this->getPeriodosAlumno($personaID);
        $periodoIngreso = $periodos[0]->ingreso;
        $periodoSalida = is_null($periodos[0]->salida) ? 'NULL' : $periodos[0]->salida;
        $sql = "SELECT semestre($periodo, $periodoIngreso, $periodoSalida) as semestre";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->semestre) ? 'Sin Periodo de Ingreso Capturado' : $result[0]->semestre);
            return $res;
        } else {
            return 'Registro de Periodos no encontrado';
        }
    }

    public function getPromedio($personaID){
       $sql = "SELECT a.promedio FROM alumno as a WHERE a.fk_id_persona='$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->promedio) ? 'Sin Promedio Capturado' : $result[0]->promedio);
            return $res;
        } else {
            return 'Registro de Promedio no encontrado';
        }
    }

    public function getEspecialidad($personaID){
       $sql = "SELECT
                    e.nombre as especialidad
                FROM
                    alumno as a
                    LEFT JOIN alumno_especialidad as ae ON ae.fk_id_alumno=a.id
                    LEFT JOIN especialidad as e ON ae.fk_id_especialidad=e.id
                WHERE
                     a.fk_id_persona = '$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->especialidad) ? 'Sin Especialidad Capturada' : $result[0]->especialidad);
            return $res;
        } else {
            return 'Registro de Promedio no encontrado';
        }
    }

    public function getRFC($personaID){
       $sql = "SELECT rfc FROM personal WHERE fk_id_persona = '$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->rfc) ? 'Sin RFC Capturado' : $result[0]->rfc);
            return $res;
        } else {
            return 'Registro de RFC no encontrado';
        }
    }

    public function getDeptoFromNumericKey($claveNumerica){
        $sql = "SELECT nombre FROM area where clavenumerica='$claveNumerica'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->nombre) ? 'Sin nombre del departamento Capturado' : $result[0]->nombre);
            return $res;
        } else {
            return 'Sin departamento asignado';
        }
    }

    public function getDepto($personaID){
       $sqlInfo = "SELECT
                        a.nombre,
                        a.nivel,
                        a.clavenumerica
                    FROM
                        personal as p
                        LEFT JOIN tecnologico_personal as tp ON tp.fk_id_personal = p.id
                        LEFT JOIN area as a ON tp.fk_id_area=a.id
                    WHERE
                        fk_id_persona = '$personaID'";
        $resInfo = DB::select($sqlInfo);
        if($resInfo){
            $nombre = $resInfo[0]->nombre;
            $nivel = $resInfo[0]->nivel;
            $clave = $resInfo[0]->clavenumerica;
            if($nivel <= 4){
                return $nombre;
            } else {
                $extracto = substr($clave,0,4);
                $claveDepto = $extracto.'00';
                $depto = $this->getDeptoFromNumericKey($claveDepto);
                return $depto;
            }
        } else {
            return 'Registro de Personal buscando su departamento no encontrado';
        }
    }

    public function getOficina($personaID){
       $sql = "SELECT
                        a.nombre
                    FROM
                        personal as p
                        LEFT JOIN tecnologico_personal as tp ON tp.fk_id_personal = p.id
                        LEFT JOIN area as a ON tp.fk_id_area=a.id
                    WHERE
                        fk_id_persona = '$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->nombre) ? 'Sin nombre de la oficina Capturado' : $result[0]->nombre);
            return $res;
        } else {
            return 'Sin oficina asignada';
        }
    }

    public function getIngreso($personaID){
        $sql = "SELECT iniciosep FROM personal WHERE fk_id_persona = '$personaID'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->iniciosep) ? 'Sin inicio en la sep Capturado' : $result[0]->iniciosep);
            if(is_numeric($res)){
                $year = substr($res,0,4);
                $fortnight = substr($res,4,2);
                $fecha = $this->getDateFromFortnight($fortnight, $year);
                return $fecha;
            } else {
                 return $res;
            }
        } else {
            return 'Registro de inicio en la sep no encontrado';
        }
    }

    public function getDateFromFortnight($quincena, $year){
        //primero detectar si es par o impar, si es par no hacer nada solo dividir entre dos y sabemos el mes que es, si es impar se le suma uno y se hace la division
        //y se obtiene el mes correspondiente, de ahí se le agrea si es 1 de o 16 de seguido del mes y el año que ya debe estar calculado antes.
        if($quincena % 2 == 0){
            $mes = $quincena/2;
            $fecha = Carbon::createFromDate($year, $mes, '16')->formatLocalized('%d de %B del %Y');
            return $fecha;
        } else {
            $mes = ($quincena+1)/2;
            $fecha = Carbon::createFromDate($year, $mes, '1')->formatLocalized('%d de %B del %Y');
            return $fecha;
        }
    }

    public function getPlaza($personaID){
        return 'A08 - Secretaria Bilingue/110071456A0800300.0000103';
    }

    public function getPuesto($personaID){
        $sql = "SELECT
                 pu.nombref,
                 pu.nombrem
                FROM
                    personal as p
                    LEFT JOIN area_personal as ap ON ap.fk_id_personal=p.id
                    LEFT JOIN area_puesto as apu ON ap.fk_id_areapuesto=apu.id
                    LEFT JOIN puesto as pu ON apu.fk_id_puesto=pu.id
                WHERE
                    fk_id_persona = '$personaID'";
        $result = DB::select($sql);
        if($result){
            $sexo = $this->getSex($personaID);
            if($sexo == 'M') {
                $res = (is_null($result[0]->nombrem) ? 'Sin nombre del puesto Capturado' : $result[0]->nombrem);
                return $res;
            } else {
                $res = (is_null($result[0]->nombref) ? 'Sin nombre del puesto Capturado' : $result[0]->nombref);
                return $res;
            }
        } else {
            return 'Registro de RFC no encontrado';
        }
    }

    public function getSex($personalID){
         $sql = "SELECT
                    sexo
                FROM
                    persona as p
                WHERE
                    id = '9d5d036f-f34f-11e8-b246-7ec04328bc85'";
        $result = DB::select($sql);
        if($result){
            $res = (is_null($result[0]->sexo) ? 'Sin sexo Capturado' : $result[0]->sexo);
            return $res;
        } else {
            return 'Registro del sexo no encontrado';
        }
    }

}
?>