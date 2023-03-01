function CrearProveedor(valor1,valor2,valor3,valor4,valor5,valor6){
	
	cadena="empresa=" + valor1 + "&direccion=" + valor2 + "&telefono=" + valor3 + "&preventista=" + valor4 + "&celular=" + valor5 + "&comentario=" + valor6;
	//alert(cadena); //QUITAMOS EL COMENTARIO PARA VER LAS VARIABLES Y SU CONTENIDO
	$.ajax({
		type:"POST",
		url:"assets/inc/create_proveedor.php",
		data:cadena,
		success:function(r){
			if(r==1){														//Si la insercion de datos es exitosa.
        		$('#tabla_proveedor').load('proveedor_tabla.php');			//Recargar el DataTaable con AJAX
        		$('#modal_crear_proveedor').on('hidden.bs.modal',function(){//Limpia los inputs del formulario, que estan en el modal
        			$(this).find('#form_nuevo_proveedor')[0].reset();
        		});
        		/*$('#c_paciente')[0].reset();*/								//Limpia los inputs del formulario con id=c_paciente
        		Swal.fire({
        			type: 'success',
					title: 'Proveedor Agregado Exitosamente.',
					showConfirmButton: false,
					timer: 2000//1500
					})
			}else{
				Swal.fire({
					type: 'error',
					title: 'Se ha Producido un Error.',
					showConfirmButton: false,
					timer: 2000//1500
					})
			}
		}
	});
}
//Esta funcion captura los datos de un registro y los envia a los inputs de un formulario
//que esta dentro de una ventana modal, para que el cliente pueda modificar los datos.
function EditarProveedor(datos){
	//Usamos el alert para verificar que los datos recuperados son los correctos.
	//alert(datos);
	vector=datos.split('||');
	//Los datos del registro son enviados a los inputs con los id's correspondientes.
	//usamos u_palabra para hacer notar que estamos realizando una actualizacion de datos
	//asi tambien usaremos c_palabra para crear un registro, etc.
	$('#prov_id').val(vector[0]);
	$('#u_empresa').val(vector[1]);
	$('#u_direccion').val(vector[2]);
	$('#u_telefono').val(vector[3]);
	$('#u_preventista').val(vector[4]);
	$('#u_celular').val(vector[5]);
	$('#u_comentario').val(vector[6]);
}

function ActualizarProveedor(){
	//Guardamos los valores .val() de los inputs del formulario que esta en el modal
	//para crear una cadena variable=valor, y enviarla por ajax para su actualizacion
	//en la BdD
	// actalizaremos todos los valores aunque en algunos casos sean los mismos valores
	// usando el adm_id en la clausura where.
	valor1 = $('#prov_id').val();
	valor2 = $('#u_empresa').val();
	valor3 = $('#u_direccion').val();
	valor4 = $('#u_telefono').val();
	valor5 = $('#u_preventista').val();
	valor6 = $('#u_celular').val();
	valor7 = $('#u_comentario').val();

	cadena ="prov_id="+valor1+
			"&empresa="+valor2+
			"&direccion="+valor3+
			"&telefono="+valor4+
			"&preventista="+valor5+
			"&celular="+valor6+
			"&comentario="+valor7;
	//alert(cadena);
	$.ajax({
		type:"POST",
		url:"assets/inc/update_proveedor.php",
		data:cadena,
		success:function(r){
			if(r==1){
        		$('#tabla_proveedor').load('proveedor_tabla.php');
        		Swal.fire({
					  type: 'success',
					  title: 'Actualizacion Exitosamente.',
					  showConfirmButton: false,
					  timer: 2000//1500
					})
			}else{
				Swal.fire({
					  type: 'error',
					  title: 'Se ha Producido un Error.',
					  showConfirmButton: false,
					  timer: 2000//1500
					})
			}
		}
	});

}

function EliminarProveedor(prov_id){
	Swal.fire({
	  title: 'Estas Seguro?',
	  text: "No podrás revertir esto!",
	  type: 'warning',
	  showCancelButton: true,
	  cancelButtonText: 'Cancelar',
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Si, eliminarlo!'
	}).then((result) => {//result es nombre cualquiera de una variable que puede tener dos valores 1 o 0, si es uno quiere decir que presionamos el Boton Si, Eliminarlo!, y si es 0 presionamos Cancelar
	  if (result.value) {//su result es 1, se intenta eliminar el registro..
	  	cadena="id="+prov_id; //cadena para el ajax
	  	$.ajax({
	  		url:"assets/inc/delete_proveedor.php",
	  		data:cadena,
	  		type:"POST",
	  		// código a ejecutar si la petición es satisfactoria;
	  		success:function(r){//r puede ser 1 o 0, es uno si la eliminacion fue exitosa, y 0 si fallo.
	  			if(r==1){
					$('#tabla_proveedor').load('proveedor_tabla.php');
					Swal.fire({
        			type: 'success',
					title: 'Tu registro a sido Borrado.',
					showConfirmButton: false,
					timer: 2000//1500
					})//Fin Swal
				}//Fin if
	  		}//Fin success

	  	});//fin ajax
	  }//Fin Cuadro de Dialogo
	})//Fin then=entonces
}
