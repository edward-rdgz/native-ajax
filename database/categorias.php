<?php
include('classExamAjax.php');

$exa = new ExamAjax();

$consulta = $exa->categorias();

header("Content-Type: application/xml");

while($fila = $consulta->fetch_array()) {
  $elementos_xml[] = "<provincia>\n<codigo>".$fila['Clave']."</codigo>\n<nombre>".$fila['Categoria']."</nombre>\n</provincia>";
}

echo "<provincias>\n".implode("\n", $elementos_xml)."\n</provincias>";
?>