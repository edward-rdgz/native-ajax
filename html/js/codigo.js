// Documento JavaScript
function llamada(url, contenedor) {
	var paginaRequerida = false;
	if (window.XMLHttpRequest) {
		// comprueba si el navegador es opera, safari, mozilla, etc.
		paginaRequerida = new XMLHttpRequest();
	} else if (window.ActiveXObject) { 
		// comprueba si el navegador es internet explorer
		try {
			paginaRequerida = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) { 
			// caso de versi�n antigua de internet explorer
			try {
				paginaRequerida = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				
			}
		}
	} else {
		return false;
	}
	
	paginaRequerida.onreadystatechange = function() { 
		// llamada a la funci�n que carga la p�gina
		pintaPagina(paginaRequerida, contenedor);
	}
	// m�todos open y send
	paginaRequerida.open('GET', url, true);
	paginaRequerida.send(null);
}

// funci�n que presenta la informaci�n 
function pintaPagina(paginaRequerida, contenedor) {
	if (paginaRequerida.readyState == 4 && (paginaRequerida.status == 200 || window.location.href.indexOf("http") == -1)) {
		contenedor.innerHTML = paginaRequerida.responseText;
	}
}