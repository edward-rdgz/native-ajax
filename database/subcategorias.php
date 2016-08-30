<?php
include('classExamAjax.php');

$exa = new ExamAjax();

$consulta = $exa->subcategorias($_POST["provincia"]);

header("Content-Type: application/xml");

while($fila = $consulta->fetch_array()) {
  $elementos_xml[] = "<municipio><codigo>".$fila['Categoria']."</codigo><nombre>".$fila['Subcategoria']."</nombre></municipio>";
}

echo "<municipios>\n".implode("\n", $elementos_xml)."</municipios>";
?>