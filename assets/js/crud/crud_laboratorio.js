function CrearLaboratorio(valor1, valor2, valor3, valor4, valor5, valor6) {
	cadena = "nombre=" + valor1 + "&nick=" + valor2 + "&direccion=" + valor3 + 
	"&email=" + valor4 + "&web=" + valor5 + "&preventista=" + valor6;
	//alert(cadena);
	$.ajax({
		type: "POST",
		url: "assets/inc/create_laboratorio.php",
		data: cadena,
		success: function (r) {
			if (r == 1) {//Si la insercion de datos es exitosa.
				$('#laboratorio_tabla').load('tabla_laboratorio.php'); //Recargar el DataTaable con AJAX
				$('#modal_crear_laboratorio').on('hidden.bs.modal', function () { //Limpia los inputs del formulario, que estan en el modal
					$(this).find('#formulario_crear_laboratorio')[0].reset();
				});
				/*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente
				Swal.fire({
					type: 'success',
					title: 'Laboratorio Agregado Exitosamente.',
					showConfirmButton: false,
					timer: 2000 //1500
				})
			} else {
				Swal.fire({
					type: 'error',
					title: 'Se ha Producido un Error.',
					showConfirmButton: false,
					timer: 2000 //1500
				})
			}
		}
	});
}

function EliminarLaboratorio(lab_id) {
	Swal.fire({
		title: 'Estas Seguro?',
		text: "No podrás revertir esto!",
		type: 'warning',
		showCancelButton: true,
		cancelButtonText: 'Cancelar',
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, eliminarlo!'
	}).then((result) => { //result es nombre cualquiera de una variable que puede tener dos valores 1 o 0, si es uno quiere decir que presionamos el Boton Si, Eliminarlo!, y si es 0 presionamos Cancelar
		if (result.value) { //su result es 1, se intenta eliminar el registro..
			cadena = "id=" + lab_id; //cadena para el ajax
			//alert(cadena);
			$.ajax({
				url: "assets/inc/delete_laboratorio.php",
				data: cadena,
				type: "POST",
				// código a ejecutar si la petición es satisfactoria;
				success: function (r) { //r puede ser 1 o 0, es uno si la eliminacion fue exitosa, y 0 si fallo.
					if (r == 1) {
						$('#laboratorio_tabla').load('tabla_laboratorio.php');
						Swal.fire({
							type: 'success',
							title: 'Tu registro a sido Borrado.',
							showConfirmButton: false,
							timer: 2000 //1500
						}) //Fin Swal
					} //Fin if
				} //Fin success

			}); //fin ajax
		} //Fin Cuadro de Dialogo
	}) //Fin then=entonces
}
function EditarLaboratorio(datos){
	//Usamos el alert para verificar que los datos recuperados son los correctos.
	//alert(datos);
	vector=datos.split('||');
	//Los datos del registro son enviados a los inputs con los id's correspondientes.
	//usamos u_palabra para hacer notar que estamos realizando una actualizacion de datos
	//asi tambien usaremos c_palabra para crear un registro, etc.
	$('#lab_id').val(vector[0]);
	$('#lab_nombre_update').val(vector[1]);
	$('#lab_nick_update').val(vector[2]);
	$('#lab_direccion_update').val(vector[3]);
	$('#lab_email_update').val(vector[4]);
	$('#lab_web_update').val(vector[5]);
	$('#lab_preventista_update').val(vector[6]);

}

function ActualizarLaboratorio(){
	//Guardamos los valores .val() de los inputs del formulario que esta en el modal
	//para crear una cadena variable=valor, y enviarla por ajax para su actualizacion
	//en la BdD
	// actalizaremos todos los valores aunque en algunos casos sean los mismos valores
	// usando el adm_id en la clausura where.
	valor1 = $('#lab_id').val();
	valor2 = $('#lab_nombre_update').val();
	valor3 = $('#lab_nick_update').val();
	valor4 = $('#lab_direccion_update').val();
	valor5 = $('#lab_email_update').val();
	valor6 = $('#lab_web_update').val();
	valor7 = $('#lab_preventista_update').val();

	cadena ="lab_id="+valor1+"&nombre="+valor2+"&nick="+valor3+"&direccion="+valor4+
			"&email="+valor5+"&web="+valor6+"&preventista="+valor7;
	//alert(cadena);
	$.ajax({
		type:"POST",
		url:"assets/inc/update_laboratorio.php",
		data:cadena,
		success:function(r){
			if(r==1){
        		$('#laboratorio_tabla').load('tabla_laboratorio.php');
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