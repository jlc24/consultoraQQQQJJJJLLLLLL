function CrearDetalle(valor1, valor2, valor3, valor4, valor5, valor6, valor7, valor8, valor9){
	cantidad_a_comprar = parseInt(valor4);
	stock = parseInt(valor5)+parseInt(valor4);
	//alert(cantidad);
	if(stock == 0){
		Swal.fire({
			title: 'Oops...No hay stock disponible',
			text: 'REALICE UN PEDIDO',
			type: 'info',
			showConfirmButton: false,
			timer: 2500
		})
		//COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
        $('#producto').trigger('focus');
	}
	if(cantidad_a_comprar < 0){
		Swal.fire({
			title: 'Oops...Error en la cantidad',
			text: 'INGRESE NUMERO MAYOR A CERO',
			type: 'info',
			showConfirmButton: false,
			timer: 2500
		})
		//COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
        $('#producto').trigger('focus');
	}
	if(cantidad_a_comprar > stock){
		Swal.fire({
			title: 'Oops...No hay suficiente stock',
			text: 'VUELVA A INTENTARLO',
			type: 'info',
			showConfirmButton: false,
			timer: 2500
		})
		//COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
        $('#producto').trigger('focus');
	}
	if( cantidad_a_comprar > 0 && cantidad_a_comprar <= stock){//SE PUEDE AÑADIR A LA TABLA DETALLE
		//CADENA PARA ENVIAR POR POST, Y AGREGAR A LA TABLA FACTURA
		cadena="fac_id="+ valor1 + "&prod_id=" + valor2 + "&prod_nombre=" + valor3 + "&prod_cantidad=" + valor4 + 
			"&stock_actual=" + valor5 + "&prod_precio_venta=" + valor6 + "&sub_total=" + valor7 + "&utilidad=" + valor8 + "&prod_codigo=" + valor9;
		//alert(cadena);
		//AJAX PARA AÑADIR DETALLE A LA TABLA DETALLE DE LA FACTURA
		$.ajax({
		type:"POST",
		url:"assets/inc/create_detalle.php",
		data:cadena,
		success:function(r){
			if(r==1){
					//RECARGAMOS LA TABLA DETALLE
					$('#tabla_detalle_factura').load('venta_tabla.php');
		            //CARGAMOS EL TOTAL NUMERAL DE LA FACTURA
		            $('#total_factura').load('factura_total.php');
					//CAMBIAMOS EL TOTAL NUMERAL EN LA CABECERA DE LA FACTURA
					$('#fac_total_cabecera').load('factura_total_cabecera.php');
					//COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO                 
              		//$('#producto input').focus();
			}else{
				Swal.fire({
					  type: 'error',
					  title: 'Error Al Registrar El Detalle',
					  showConfirmButton: false,
					  timer: 2000//1500
					})
					//COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO                 
              		$('#producto input').focus();
			}
		  }
		});//FIN AJAX	
	}//FIN IF
}

function EliminarDetalle(datos){
	vector=datos.split('||');
	cadena="det_id=" + vector[0] + "&sumar_stock="+vector[1] + "&prod_id="+vector[2];
	//alert(cadena);
	//swal('OK!',cadena,'success')
	 $.ajax({
	 	url:"assets/inc/delete_detalle.php",
	 	data:cadena,
	 	type:"POST",
	 	success:function(r){//r puede ser 1 o 0, es 1 si la eliminacion fue exitosa, y 0 si fallo.
	 		if(r==1){
				//RECARGAMOS LA TABLA DETALLE
				$('#tabla_detalle_factura').load('venta_tabla.php');
		        //CARGAMOS EL TOTAL NUMERAL DE LA FACTURA
		        $('#total_factura').load('factura_total.php');
		        //CAMBIAMOS EL TOTAL NUMERAL DE LA CABECERA DE LA FACTURA
		        $('#fac_total_cabecera').load('factura_total_cabecera.php');
				//RECARGAMOS EL TOTAL LITERAL
				$('#literalTotal').load('literalTotal.php');
				//COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO                 
          		//$('#producto input').focus();
          		$('#producto').trigger('focus');
			}//Fin if
	 	}//Fin success
	 });//fin ajax
}


function CrearFactura(valor1, valor2, valor3, valor4, valor5, valor6){
	/*valor1 = parseInt($('#fac_id').val());
	valor2 = $('#cli_id').val();
	valor3 = $('#cli_nombre').val();
	valor4 = $('#user_id').val();
	valor5 = $('#user_nombre').val();
	valor6 = $('#fac_total').val();*/
	//VERIFICAMOS SI AL MENOS HAY UN PRODUCTO REGISTRADO
	if (valor6 == 0) {//SI EL TOTAL ES CERO
		Swal.fire({
			title: 'Oops...Registre Al Menos Un Producto',
			text: 'BUSQUE UN PRODUCTO',
			type: 'info',
			showConfirmButton: false,
			timer: 2500,
			onAfterClose: () => {
                setTimeout(() => $("#producto").focus(), 110);
            }
		})
		return false;
	}

	if(valor3 == ""){//SI LA FACTURA NO CI-NIT ni NOMBRE DEL CLIENTE
		Swal.fire({
			title: 'Oops...Ingrese Datos del Cliente',
			text: 'INGRESE CI ó NIT PARA BUSCAR',
			type: 'info',
			showConfirmButton: false,
			timer: 2500,
			onAfterClose: () => {
                setTimeout(() => $("#fac_ci_nit").focus(), 110);
            }
		})
		//document.getElementById("cli_ci_nit").focus();
		return false;
	}
	//AJAX PARA GUARDAR TOTAL DE UNA FACTURA
	if(valor6 > 0 && valor3 != ""){//SI EL TOTAL ES MAYOR A CERO, Y EL NOMBRE DEL CLIENTE NO ESTA VACIO
		cadena = "fac_id="+valor1+"&cli_id="+valor2+"&cli_nombre="+valor3+"&adm_id="+valor4+"&adm_nombre="+valor5+"&fac_total="+valor6;
		//swal('OK!',cadena,'success')//numero de la factura
		alert(cadena);
		$.ajax({
			type:"POST",
			url:"assets/inc/create_factura.php",
			data:cadena,
			success:function(r){
				if(r==1){
	        		//RECARGAMOS LA TABLA DETALLE
					$('#tabla_detalle_factura').load('venta_tabla.php');
					//RECARGAMOS EL NUMERO DE FACTURA ACTUAL
			        $('#numero_factura').load('assets/inc/create_numero_factura.php');
		            //CAMBIAMOS EL TOTAL NUMERAL DE LA FACTURA A CERO
		            $('#fac_total').val('0.00');
		            $('#fac_total_cabecera').text('0.00');
					//LIMPIAMOS LOS DATOS DEL FORMULARIO, CI/NIT y NOBRE CLIENTE
					$('#fac_ci_nit').val('');
					$('#fac_nombre').val('');
					//COLOCAMOS EL FOCO EN EL INPUT SEARCH PARA BUSCAR EL MEDICAMENTO
					//$('#producto').trigger('focus');
					$("#producto").focus();
					//COLOCAMOS EL SWAL AL FINAL CASO CONTRARIO EL FOCO EN EL INPUT PRODUCTO SE PIERDE
					Swal.fire({
						  type: 'success',
						  title: 'Factura Registrada Exitosamente',
						  text: 'AHORA YA PUEDE REALIZAR OTRA VENTA',
						  showConfirmButton: false,
						  timer: 2000
						})
				}else{
					Swal.fire({
						  type: 'error',
						  title: 'Error al Registrar la Factura',
						  showConfirmButton: false,
						  timer: 2000
						})
				}
			}
		});//FIN AJAX
		//REFRESCA UNICAMENTE EL DOM CON id=contenido, ES OBLIGATORIO EL ESPACIO
		//DESPUES DEL load TAL Y COMO SE VE.
		//$("#contenido").load();
	}
}