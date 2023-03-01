function CrearMedicamento(valor1, valor2, valor3, valor4, valor5, valor6, valor7, valor8, valor9, valor10, valor11, valor12, valor13, valor14, valor15) {
	cadena = "nombre=" + valor1 + "&propaganda=" + valor2 + "&forma=" + valor3 + "&ingrediente=" + valor4 + "&laboratorio=" + valor5 + 
	"&nicklaboratorio=" + valor6 + "&representante=" + valor7 + "&codigo=" + valor8 + "&stock_minimo=" + valor9 + "&ubicacion=" + valor10 + 
	"&caducidad=" + valor11 + "&stock=" + valor12  + "&precio_compra=" + valor13 + "&precio_unitario=" + valor14 + "&precio_venta=" + valor15;
	alert(cadena);
	$.ajax({
		type: "POST",
		url: "assets/inc/create_medicamento.php",
		data: cadena,
		success: function (r) {
			if (r == 1) {//Si la insercion de datos es exitosa.
				$('#medicamento_tabla').load('tabla_medicamento.php'); //Recargar el DataTaable con AJAX
				$('#modal_crear_medicamento').on('hidden.bs.modal', function () { //Limpia los inputs del formulario, que estan en el modal
					$(this).find('#formulario_crear_medicamento')[0].reset();
				});
				/*$('#c_paciente')[0].reset();*/ //Limpia los inputs del formulario con id=c_paciente
				Swal.fire({
					type: 'success',
					title: 'Medicamento Agregado Exitosamente.',
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

function EliminarMedicamento(prod_id) {
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
			cadena = "id=" + prod_id; //cadena para el ajax
			alert(cadena);
			$.ajax({
				url: "assets/inc/delete_medicamento.php",
				data: cadena,
				type: "POST",
				// código a ejecutar si la petición es satisfactoria;
				success: function (r) { //r puede ser 1 o 0, es uno si la eliminacion fue exitosa, y 0 si fallo.
					if (r == 1) {
						$('#medicamento_tabla').load('tabla_medicamento.php');
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
function EditarMedicamento(datos){
	//Usamos el alert para verificar que los datos recuperados son los correctos.
	//alert(datos);
	vector=datos.split('||');
	//Los datos del registro son enviados a los inputs con los id's correspondientes.
	$('#prod_id_update').val(vector[0]);
	$('#prod_nombre_comercial_update').val(vector[1]);
	$('#prod_propaganda_update').val(vector[2]);
	$('#prod_forma_update').val(vector[3]);
	$('#prod_ingrediente_update').val(vector[4]);
	$('#prod_laboratorio_update').val(vector[6]);
	$('#prod_nicklaboratorio_update').val(vector[7]);
	$('#prod_representante_update').val(vector[9]);
	$('#prod_codigo_update').val(vector[10]);
	//$('#prod_stock_minimo_update').val(vector[11]);
	$('#prod_ubicacion_update').val(vector[12]);
	//$('#prod_caducidad_update').val(vector[13]);
	$('#prod_stock_update').val(vector[14]);
	//$('#prod_precio_unitario_update').val(vector[15]);
	$('#prod_precio_venta_update').val(vector[16]);
}

function ActualizarMedicamento(){

	var datos = $('#formulario_editar_medicamento').serialize();
	//alert(datos);
	//return false;
	$.ajax({
		type:"POST",
		url:"assets/inc/update_medicamento.php",
		data:datos,
		success:function(r){
			if(r==1){
        		$('#medicamento_tabla').load('tabla_medicamento.php');
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
function AbastecerMedicamento(datos){
	//ESTA FUNCION RECUPERA LOS DATOS NECESARIOS PARA REGISTRAR LA COMPRA DEL PRODUCT0
	//alert(datos);
	vector=datos.split('||');
	$('#prod_id_abastecer').val(vector[0]);//prod_id
	$('#prod_nombre_comercial_abastecer').val(vector[1]);//prod_nombre_comercial
	$('#prod_fecha_vencimiento_abastecer').val(vector[2]);//prod_caducidad
	$('#prod_stock_abastecer').val(vector[3]);//prod_stock
	//COLOCAMOS EL FOCO EN EL INPUT
	$('#modal_abastecer_medicamento').on('shown.bs.modal', function (){$('#cantidad_comprada_abastecer').focus();});
}

function HistorialMedicamento(datos){
  /*RECIBE COMO DATOS EL ID y NOMBRE DEL PRODUCTO, EL ID SE ACTUALIZA EN LA
  TABLA CONFIGURACION, LUEGO SE MUESTRA EL RESULTADO DE LA CONSULTA
  PARA ESE ID, EN EL DIV ---> #tabla_producto_historial */
  vector=datos.split('||');
  cadena="prod_id=" + vector[0];
  document.getElementById("prod_nombre").innerHTML = vector[1];
  //alert(vector);
  $.ajax({
    type:"POST",
    url:"assets/inc/update_producto_id.php",
    data:cadena,
    success:function(r){
      if(r==1){
        $('#tabla_compra_historial').load('tabla_compra_historial.php');
      }//Fin if
    }//Fin success
  });//fin ajax

}