<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Consultas\DBModel;

class DashboardController extends Controller
{
	protected $consultas;

	public function __construct()
	{
		$this->middleware('auth');
		$this->consultas = new DBModel();
	}

	public function index()
	{
		$user = Auth::user();
		$tipoPersona = 'N';
		if ($this->consultas->isEmployee($user->fk_id_persona)) {
			if ($this->consultas->isStudent($user->fk_id_persona)) {
				$tipoPersona = 'M';
			} else {
				$tipoPersona = 'E';
			}
		} else {
			if ($this->consultas->isStudent($user->fk_id_persona)) {
				$tipoPersona = 'S';
			} else {
				$tipoPersona = 'N';
			}
		}

		$datosGral = [
			'nombre' => $this->consultas->getNombre($user->fk_id_persona),
			'curp' => $this->consultas->getCurp($user->fk_id_persona),
			'correo' => $user->email,
			'tipoP' => $tipoPersona,
		];

		if ($tipoPersona == 'S' or $tipoPersona == 'M') {
			$datosAlumno = [
				'nocontrol' => $this->consultas->getNoControl($user->fk_id_persona),
				'carrera' =>  $this->consultas->getCarrera($user->fk_id_persona),
				'ingreso' => $this->consultas->getPeriodo($user->fk_id_persona),
				'semestre' => $this->consultas->getSemestre($user->fk_id_persona),
				'promedio' => $this->consultas->getPromedio($user->fk_id_persona),
				'especialidad' => $this->consultas->getEspecialidad($user->fk_id_persona),
			];/*tablas: alumno(#control, promedio) periodo(periodo_ingreso por medio del FK de alumno) tecnologico_plan, plan, carrera(para obtener la carrera) tecnologico_plan(especialidad), preguntar como usar la funcion semestre*/
		}
		if ($tipoPersona == 'E' or $tipoPersona == 'M') {
			$datosPersonal = [
				'rfc' => $this->consultas->getRFC($user->fk_id_persona),
				'depto' => $this->consultas->getDepto($user->fk_id_persona),
				'oficina' => $this->consultas->getOficina($user->fk_id_persona),
				'ingreso' => $this->consultas->getIngreso($user->fk_id_persona),
				'plaza' => $this->consultas->getPlaza($user->fk_id_persona),
				'puesto' => $this->consultas->getPuesto($user->fk_id_persona),
			];/*Las aplicaciones se deben registrar en la tabla aplicacion, los roles se encuentran en la tabla rol y el cruce de ambos donde se encuentra el listado de lo que la persona puede hacer es en aplicacion_rol*/
		}
		//crear ciclo para los diferentes roles que pueda tener el usuario
		$Roles = $this->consultas->getWebRoles($user->fk_id_persona);
		$listado = array();
		if ($Roles) {
			//crear arreglo multidimensional y enviarlo
			foreach ($Roles as $rol) {
				if (array_key_exists($rol->sitio, $listado)) {
					$total = count($listado[$rol->sitio]);
					$listado[$rol->sitio][$total] = $rol->rol;
				} else {
					$listado[$rol->sitio][0] = $rol->rol;
				}
			}
			if ($tipoPersona == 'M') {
				return view('welcome', compact('datosPersonal', 'datosAlumno', 'datosGral', 'listado'));
			} else {
				if ($tipoPersona == 'E') {
					return view('welcome', compact('datosPersonal', 'datosGral', 'listado'));
				} else {
					if ($tipoPersona == 'S') {
						return view('welcome', compact('datosAlumno', 'datosGral', 'listado'));
					} else {
						return view('welcome', compact('datosGral', 'listado'));
					}
				}
			}
		} else {
			if ($tipoPersona == 'M') {
				return view('welcome', compact('datosPersonal', 'datosAlumno', 'datosGral'));
			} else {
				if ($tipoPersona == 'E') {
					return view('welcome', compact('datosPersonal', 'datosGral'));
				} else {
					if ($tipoPersona == 'S') {
						return view('welcome', compact('datosAlumno', 'datosGral'));
					} else {
						return view('welcome', compact('datosGral'));
					}
				}
			}
		}
	}
}
