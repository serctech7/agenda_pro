<?php namespace App\Controllers;
use App\Models\categoriasModel;
use App\Models\contactosModel;
class ContactoController extends BaseController
{
	public function contactos(){
		$Crud = new contactosModel();
		$Crud2 = new categoriasModel();
		$datos = $Crud->listarContactos();
		$datos2 = $Crud2->listarCategoria();

		$mensaje = session('mensaje');

		$data = [
			"datos" => $datos,
			"datos2" => $datos2,
			"mensaje" => $mensaje
		];
		return view('contactos', $data);
	}
	public function crear(){
		$datos = [
			"nombre" => $_POST['nombre'],
			"paterno" => $_POST['paterno'],
			"materno" => $_POST['materno'], 
			"telefono" => $_POST['telefono'],
			"email" => $_POST['email'],
			"id_categoria" => $_POST['id_categoria']
		];
		$Crud = new contactosModel();
		$respuesta = $Crud->insertar($datos);

		if ($respuesta > 0){
			return redirect()->to(base_url().'/Contactos')->with('mensaje','1');
		}else{
			return redirect()->to(base_url().'/Contactos')->with('mensaje','0');
		}

	}

	public function actualizar(){
		$datos = [
			"nombre" => $_POST['nombre'],
			"paterno" => $_POST['paterno'],
			"materno" => $_POST['materno'],
			"telefono" => $_POST['telefono'],
			"email" => $_POST['email'],
			"id_categoria" => $_POST['id_categoria']
		];
		$idNombre =  $_POST['idNombre'];

		$Crud = new contactosModel();

		$respuesta = $Crud->actualizar($datos, $idNombre);

		if ($respuesta){
			return redirect()->to(base_url().'/Contactos')->with('mensaje','2');
		}else{
			return redirect()->to(base_url().'/Contactos')->with('mensaje','3');
		}
	}

	public function obtenerNombre($idNombre){
		$data = ["id_contacto" => $idNombre];
		$Crud = new contactosModel();
		$Crud2 = new categoriasModel();
		$respuesta = $Crud->obtenerContactos($data);
		$datos2 = $Crud2->listarCategoria();
		$datos = [
					"datos"=>$respuesta,
					"datos2" => $datos2	
				];

		return view('actualizarcont', $datos);
	}

	public function eliminar($idNombre){
		$Crud = new contactosModel();
		$data = ["id_contacto" => $idNombre];

		$respuesta = $Crud->eliminar($data);

		if ($respuesta){
			return redirect()->to(base_url().'/Contactos')->with('mensaje','4');
		}else{
			return redirect()->to(base_url().'/Contactos')->with('mensaje','5');
		}
	}
	//--------------------------------------------------------------------

}