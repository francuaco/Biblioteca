//==========================================================================
//==========================================================================
//==========================================================================


function validar(){


	lib_descripcion	= document.getElementById("lib_descripcion").value;
	lib_autor		= document.getElementById("lib_autor").value;
	lib_categoria	= document.getElementById("lib_categoria").value;
	lib_cursos		= document.getElementById("lib_cursos").value;
	file		= document.getElementById("id-input-file-3").value;

	lib_descripcion = empty(lib_descripcion);
	lib_autor = empty(lib_autor);
	lib_categoria = empty(lib_categoria);
	lib_cursos = empty(lib_cursos);
	file = empty(file);

	if(lib_descripcion == true){alert('El Nombre del Libro no puede ir vacio');return}
	if(lib_autor == true){alert('El Nombre del Autor no puede ir vacio');return}
	if(lib_categoria == true){alert('La Categoria del Libro no puede ir vacio');return}
	if(lib_cursos == true){alert('El curso al cual sera Asignado el Libro no puede ir vacio');return}
	if(file == true){alert('Debe de Seleccionar un Libro para Agregar a la Biblioteca Virtual');return}

	document.getElementById("form").submit();
}

function empty(mixed_var) {
  //  discuss at: http://phpjs.org/functions/empty/
  // original by: Philippe Baumann
  //    input by: Onno Marsman
  //    input by: LH
  //    input by: Stoyan Kyosev (http://www.svest.org/)
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Onno Marsman
  // improved by: Francesco
  // improved by: Marc Jansen
  // improved by: Rafal Kukawski
  //   example 1: empty(null);
  //   returns 1: true
  //   example 2: empty(undefined);
  //   returns 2: true
  //   example 3: empty([]);
  //   returns 3: true
  //   example 4: empty({});
  //   returns 4: true
  //   example 5: empty({'aFunc' : function () { alert('humpty'); } });
  //   returns 5: false

  var undef, key, i, len;
  var emptyValues = [undef, null, false, 0, '', '0'];

  for (i = 0, len = emptyValues.length; i < len; i++) {
    if (mixed_var === emptyValues[i]) {
      return true;
    }
  }

  if (typeof mixed_var === 'object') {
    for (key in mixed_var) {
      // TODO: should we check for own properties only?
      //if (mixed_var.hasOwnProperty(key)) {
      return false;
      //}
    }
    return true;
  }

  return false;
}

//============================RELOAD==============================================

		function reload(){

			window.location.reload(true);

		}






//==========================================================================
//==========================================================================
//==========================================================================