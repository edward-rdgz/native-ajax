<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Listas desplegables encadenadas</title>

<script type="text/javascript">
var peticion = null;

function inicializa_xhr() {
  if (window.XMLHttpRequest) {
    return new XMLHttpRequest(); 
  } else if (window.ActiveXObject) {
    return new ActiveXObject("Microsoft.XMLHTTP"); 
  } 
}

function muestraProvincias() {
  if (peticion.readyState == 4) {
    if (peticion.status == 200) {
      var lista = document.getElementById("provincia");
      var documento_xml = peticion.responseXML;
      var provincias = documento_xml.getElementsByTagName("provincias")[0];
      var lasProvincias = provincias.getElementsByTagName("provincia");
      lista.options[0] = new Option("- selecciona -");
      
      // Método 1: Crear elementos Option() y añadirlos a la lista
      for(i=0; i<lasProvincias.length; i++) {
        var codigo = lasProvincias[i].getElementsByTagName("codigo")[0].firstChild.nodeValue;
        var nombre = lasProvincias[i].getElementsByTagName("nombre")[0].firstChild.nodeValue;
        lista.options[i+1] = new Option(nombre, codigo);
      }

    }
  }
}

function cargaMunicipios() {
  var lista = document.getElementById("provincia");
  var provincia = lista.options[lista.selectedIndex].value;
  if(!isNaN(provincia)) {
    peticion = inicializa_xhr();
    if (peticion) {
      peticion.onreadystatechange = muestraMunicipios;
      peticion.open("POST", "subcategorias.php?nocache=" + Math.random(), true);
      peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      peticion.send("provincia=" + provincia);
    }
  }
}

function muestraMunicipios() {
  if (peticion.readyState == 4) {
    if (peticion.status == 200) {
      var lista = document.getElementById("municipio");
      var documento_xml = peticion.responseXML;

      var municipios = documento_xml.getElementsByTagName("municipios")[0];
      var losMunicipios = municipios.getElementsByTagName("municipio");

      // Borrar elementos anteriores
      lista.options.length = 0;
      
      // Se utiliza el método de crear elementos Option() y añadirlos a la lista
      for(i=0; i<losMunicipios.length; i++) {
        var codigo = losMunicipios[i].getElementsByTagName("codigo")[0].firstChild.nodeValue;
        var nombre = losMunicipios[i].getElementsByTagName("nombre")[0].firstChild.nodeValue;
        lista.options[i] = new Option(nombre, codigo);
      }
    }
  }
}

window.onload = function() {
  peticion = inicializa_xhr();
  if(peticion) {
    peticion.onreadystatechange = muestraProvincias;
    peticion.open("POST", "categorias.php?nocache="+Math.random(), true);
    peticion.send(null);
  }

  document.getElementById("provincia").onchange = cargaMunicipios;
}

</script>
</head>

<body>
<h1>Listas desplegables encadenadas</h1>

<form>
  <label>Categorias</label>
  <select id="provincia">
    <option>Cargando...</option>
  </select>
  <br/><br/>
  <label>Subcategorias</label>
  <select id="municipio">
    <option>- selecciona una subcategoria -</option>
  </select>
</form>

</body>
</html>
