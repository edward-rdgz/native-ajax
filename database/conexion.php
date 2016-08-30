<?php
class conexion {  // APERTURA DE LA CLASE
	
	private $servidor; 
	private $usuario; 
	private $contrasena; 
	private $basedatos; 
	protected $conexion; 
	
	public function __construct() {  // CONSTRUCTOR DE LA CLASE
		$this->servidor = "localhost"; 
		$this->usuario = "root"; 
		$this->contrasena = ""; 
		$this->basedatos = "lista-encadenada"; 
	}
	
	public function conectar() {  // CONEXION 
		$this->conexion = new mysqli($this->servidor, $this->usuario, $this->contrasena, $this->basedatos) or die("Error en la conexión");
	}
	
	public function desconectar() {  // DESCONEXION
		$this->conexion->close() or die("Error en la desconexión");
	}
	
}  // CIERRE DE LA CLASE
?>