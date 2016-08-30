<?php
include('conexion.php');

class ExamAjax extends conexion { // APERTURA DE LA CLASE

	public function categorias() { // CATEGORIAS
		$this->conectar();
		$sql = "SELECT * FROM categorias";
		$consulta = $this->conexion->query($sql) or die("Error en la consulta");
		$this->desconectar();
		return $consulta;
	}
	
	public function subcategorias($id) { // SUBCATEGORIAS
		$this->conectar();
		$sql = "SELECT * FROM subcategorias WHERE Categoria ='".$id."'";
		$consulta = $this->conexion->query($sql) or die("Error en la consulta");
		$this->desconectar();
		return $consulta;
	}
	
} // CIERRE DE LA CLASE
?>