<?php
//CONEXION A LA BdD
include('assets/inc/conexion.php');
//IMPRIMIMOS LAS FACTURAS CON ESTADO 1, QUE ESTAN FINALIZADA Y CANCELADAS DE LA SEMANA ACTUAL
//OBTENEMOS EL MES PARA REALIZAR EL REPORTE
$consulta = "SELECT numero_detalle FROM configuracion";
$result = mysqli_query($conexion,$consulta);
$fila = mysqli_fetch_row($result);
$num = (int)$fila[0];

//SI EL NUMERO DE NOTA DE VENTA ES MAYOR A CERO, MOSTRAMOS LOS DATOS RECUPERADOS
//PARA EL NUMERO DE NOTA DE VENTA RECUPERADO DE LA TABLA DE VENTAS AL CREDITO.
if ($num > 0) {
    $sql = "SELECT fac_id, fac_nombre_cliente, fac_nombre_usuario, fac_total, fac_fecha_hora, fac_forma_pago FROM factura WHERE fac_id = $num";
    $result1 = mysqli_query($conexion, $sql);
    $fila1 = mysqli_fetch_assoc($result1);
?>
<form id="formulario_actualizar_factura">
    <h5>DATOS DE LA NOTA DE VENTA:</h5>
    <div class="form-group">
        <input type="hidden" id="fac_id_update" name="fac_id_update" value="<?php echo $fila1['fac_id'];?>">
        <label class="col-form-label">Nombre del Cliente</label>
        <input type="text" class="form-control" id="fac_nombre" name="fac_nombre" value="<?php echo $fila1['fac_nombre_cliente'];?>" readonly="">
    </div>
    <div class="form-group">
        <label class="col-form-label">Nombre del Cajero</label>
        <input type="text" class="form-control" id="fac_usuario" name="fac_usuario" value="<?php echo $fila1['fac_nombre_usuario'];?>" readonly="">
    </div>
    <div class="form-row">
        <div class="form-group col-sm-6">
            <label class="col-form-label">Fecha de Venta</label>
            <input type="text" class="form-control" id="fac_fecha_hora" name="fac_fecha_hora" value="<?php echo $fila1['fac_fecha_hora'];?>" readonly="">
        </div>
        <div class="form-group col-sm-6">
            <label class="col-form-label">Forma de Pago</label>
            <select class="custom-select form-control-sm" id="fac_forma_pago" name="fac_forma_pago">
                <option value="CONTADO">CONTADO</option>
                <option value="CREDITO" selected="true">CRÉDITO</option>
            </select>
        </div>
        <div class="form-group col-sm-4">
            <label class="col-form-label">Total a Pagar</label>
            <input type="number" class="form-control" id="fac_total" name="fac_total" value="<?php echo $fila1['fac_total'];?>" readonly="">
        </div>
        <div class="form-group col-sm-4">
            <label class="col-form-label">Importe&nbsp;&nbsp;<a href="javascript:void(0);" data-toggle="modal" data-target="#modal_dolar_boliviano"><i style="color: purple;" class="fe-refresh-cw btnDetalleFactura"></i></a></label>
            <input type="number" min="0.00" step="0.50" lang="en-US" class="form-control" id="fac_importe" name="fac_importe" value="0.00">
        </div>
        <div class="form-group col-sm-4">
            <label class="col-form-label">Cambio</label>
            <input type="number" class="form-control" readonly="" id="fac_cambio" name="fac_cambio" value="0.00">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12" align="center">
            <button type="button" id="update_factura" class="btn btn-block mt-1 btn-purple">Pagar Deuda</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        //VERIFICAMOS PRIMERO QUE SE HAYA CAMBIADO A CONTADO Y QUE EL MONTO DE PAGO SEA MAYOR O IGUAL
        //A LA DEUDA, FINALMENTE ACTUALIZAMOS EL MODO DE PAGO IMPORTE Y CAMBIO Y ESTADO DE LA FACTURA A 1

        //CALCULA EL CAMBIO, DADO EL TOTAL DE LA FACTURA
        $("#fac_importe").on('change keyup input paste',function() {
            var total = document.getElementById("fac_total").value;
            var importe = $(this).val();
            var cambio = (parseFloat(importe) - parseFloat(total)).toFixed(2);
            document.getElementById("fac_cambio").value = cambio;
        });
        $('#update_factura').click(function() {
            //var total = Number.parseFloat($('#fac_total').val()).toFixed(2);
            //var importe = Number.parseFloat($('#fac_importe').val()).toFixed(2);
            //var cambio = Number.parseFloat($('#fac_cambio').val()).toFixed(2);
            //VERIFICAMOS SI EL MODO DE PAGO ES AL CONTADO
            if($("#fac_forma_pago option:selected").val() == 'CONTADO'){
                //VERIFICAMOS SI SE HA REGISTRADO UN MONTO DE PAGO O IMPORTE VALIDO
                if (parseFloat($('#fac_importe').val()) >= parseFloat($('#fac_total').val())) {
                    var datos = $('#formulario_actualizar_factura').serialize();
                    //alert(datos); return false;
                    $.ajax({
                        type: "POST",
                        url: "assets/inc/update_factura.php",
                        data: datos,
                        success: function(response) {
                            if (response == 1) {
                                //RECARGAMOS LA TABLA DETALLE
                                $('#tabla_credito').load('salesreport_credito.php');
                                //$("#producto").focus();
                                //COLOCAMOS EL SWAL AL FINAL CASO CONTRARIO EL FOCO EN EL INPUT PRODUCTO SE PIERDE
                                Swal.fire({
                                    type: 'success',
                                    title: 'Nota de Venta Pagada Exitosamente',
                                    text: 'AHORA YA PUEDE REALIZAR OTRA PAGO',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                $("#modal_actualizar_pago").modal('hide');
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Error al Actualizar la Nota de Venta',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            }
                        }
                    }); //FIN AJAX
                    //REFRESCA UNICAMENTE EL DOM CON id=contenido, ES OBLIGATORIO EL ESPACIO
                    //DESPUES DEL load TAL Y COMO SE VE.
                    $("#contenido").load();
                } else {
                    Swal.fire({
                        title: 'Oops...Ingrese Monto de Pago Correcto',
                        text: 'INGRESE IMPORTE',
                        type: 'info',
                        showConfirmButton: false,
                        timer: 2500,
                        onAfterClose: () => {
                            setTimeout(() => $("#fac_importe").focus(), 110);
                        }
                    })
                    return false;
                }
            }else{
                Swal.fire({
                        title: 'Oops...Seleccione la forma de Pago Correcta',
                        text: 'ESCOGA PAGO AL CONTADO',
                        type: 'info',
                        showConfirmButton: false,
                        timer: 2500,
                        onAfterClose: () => {
                            setTimeout(() => $("#fac_forma_pago").focus(), 110);
                        }
                    })
                    return false;
            }
        });
    });
</script>
<?php
}
?>