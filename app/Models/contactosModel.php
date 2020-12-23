<?php namespace App\Models;

	use CodeIgniter\Model;

 	class contactosModel extends Model{
 		public function listarContactos(){
 			$Contactos = $this->db->query('SELECT A.id_contacto, A.nombre, A.paterno, A.materno, A.telefono, A.email, A.id_categoria, B.categoria FROM t_contactos A, t_categorias B where B.id_categoria=A.id_categoria');
 			return $Contactos->getResult();
 		}
 		public function insertar($datos){
 			$Contactos = $this->db->table('t_contactos');
 			$Contactos->insert($datos);

 			return $this->db->insertID();
 		}

 		public function obtenerContactos($data){
 			$Contactos = $this->db->table('t_contactos');
 			$Contactos->where($data);
 			return $Contactos->get()->getResultArray();
 		}

 		public function actualizar($data, $idNombre){
 			$Contactos = $this->db->table('t_contactos');
 			$Contactos->set($data);
 			$Contactos->where('id_contacto',$idNombre);
 			return $Contactos->update();
 		}

 		public function eliminar($data){
 			$Contactos = $this->db->table('t_contactos');
 			$Contactos->where($data);
 			return $Contactos->delete();
 		}
 	}