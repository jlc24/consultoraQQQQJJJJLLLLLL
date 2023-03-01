                        <!-- MODAL PARA LA ABASTECER O AÑADIR LA COMPRA DE UN PRODUCTO -->
                        <?php include("assets/inc/conexion.php");?>
                        <!-- MODAL PARA ABASTECER MEDICAMENTO -->
                        <?php
                            //OBTENEMOS EL ID DEL PRODUCTO, DE LA TABLA CONFIGURACION
                            //$consulta = "SELECT prod_id FROM configuracion";
                            //$resultado = mysqli_query($conexion,$consulta);
                            //$fila = mysqli_fetch_row($resultado);
                            //$numero = (int)$fila[0];

                            $sql="SELECT *FROM producto WHERE prod_id = (SELECT prod_id FROM configuracion)";
                            $result=mysqli_query($conexion,$sql);
                            //if (!empty($result)) {
                            if ($result == TRUE) {
                                $row = mysqli_fetch_row($result);
            
                        ?>
                            <form class="form-horizontal" id="formulario_abastecer_medicamento">
                                <div class="form-row">
                                    <!-- ID DEL PRODUCTO QUE QUEREMOS ABASTECER -->
                                    <input type="hidden" class="form-control form-control-sm" id="prod_id_abastecer" name="prod_id_abastecer" value="<?php echo $row[0];?>">
                                    <div class="form-group col-lg-4">
                                        <label class="col-form-label">Nombre Comercial</label>
                                        <input type="text" style="font-weight: 500; background-color:#EBF9D6;" class="form-control form-control-sm" id="prod_nombre_comercial_abastecer" name="prod_nombre_comercial_abastecer" readonly="" value="<?php echo $row[1];?>">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="col-form-label">P.Compra (Bs)</label>
                                        <input type="number" min="0" style="font-weight: 500; background-color:#EBF9D6;" class="form-control form-control-sm" id="precio_unitario_anterior" name="precio_unitario_anterior" readonly="" value="<?php echo $row[15];?>">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="col-form-label">Vendedor</label>
                                        <input type="text" style="font-weight: 500; background-color:#EBF9D6;" class="form-control form-control-sm" id="prod_laboratorio_abastecer" name="prod_laboratorio_abastecer" value="<?php echo $row[9];?>">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="col-form-label">Código</label>
                                        <!-- STOCK ACTUAL DEL PRODUCTO -->
                                        <input type="text" style="font-weight: 500; background-color:#EBF9D6;" class="form-control form-control-sm" id="prod_codigo_abastecer" name="prod_codigo_abastecer" readonly="" value="<?php echo $row[10];?>">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="col-form-label">Stock Actual</label>
                                        <!-- STOCK ACTUAL DEL PRODUCTO -->
                                        <input type="number" style="font-weight: 500; background-color:#EBF9D6;" class="form-control form-control-sm" id="prod_stock_abastecer" name="prod_stock_abastecer" readonly="" value="<?php echo $row[14];?>">
                                    </div>

                                    <div class="form-group col-lg-2">
                                        <label class="col-form-label">Cantidad</label>
                                        <input type="number" min="1" value="" class="form-control form-control-sm" id="cantidad_comprada_abastecer" name="cantidad_comprada_abastecer">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="col-form-label">P.Compra (Bs)</label>
                                        <input type="number" min="0" value="" class="form-control form-control-sm" id="precio_compra_abastecer" name="precio_compra_abastecer">
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="col-form-label">Desc. (%)</label>
                                        <input type="number" min="0" value="0" class="form-control form-control-sm" id="descuento_compra_abastecer" name="descuento_compra_abastecer">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label class="col-form-label">P.Unit. (Bs)</label>
                                        <input type="number" min="0" value="0" class="form-control form-control-sm" id="precio_unitario_abastecer" name="precio_unitario_abastecer">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label class="col-form-label">P.Venta (Bs)</label>
                                        <input type="number" min="0" class="form-control form-control-sm" id="precio_venta_abastecer" name="precio_venta_abastecer" value="<?php echo $row[16];?>">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label class="col-form-label">Caducidad</label>
                                        <input type="date" style="font-weight: 500; background-color:#EBF9D6;" class="form-control form-control-sm" id="prod_fecha_vencimiento_actual" name="prod_fecha_vencimiento_actual" readonly="" value="<?php echo $row[13];?>">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label class="col-form-label">Vencimiento</label>
                                        <input type="date" class="form-control form-control-sm" id="prod_fecha_vencimiento_abastecer" name="prod_fecha_vencimiento_abastecer">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label class="col-form-label">Tipo Compra</label>
                                        <select class="custom-select custom-select-sm" id="prod_tipo_compra_abastecer" name="prod_tipo_compra_abastecer">
                                            <option value="CONTADO">CONTADO</option>
                                            <option value="CREDITO">CRÉDITO</option>
                                            <option value="OTRO">OTRO</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label class="col-form-label">Detalle de Compra</label>
                                        <input type="text" class="form-control form-control-sm" id="prod_detalle_abastecer" name="prod_detalle_abastecer" placeholder="Ej. Caja de 6 unidades">
                                    </div>
                                </div>
                            </form>
                        <?php
                            }
                        ?>
                        <script>
                            /*CALCULA EL PRECIO UNITARIO, CUANDO CAMBIA EL PRECIO DE COMPRA, DADO LA CANTIDAD
                            Cuando ingreso el valor de cantidad comprada no pasa nada, no se realiza ningun calculo....
                            pero cuando ingreso el segundo dato de precio de compra se puede dividir precio/cantidad y suponiendo
                            que el descuento es cero se puede calculamos el precio de venta.*/
                            $("#cantidad_comprada_abastecer").on('keyup change',function() {
                                var cantidad = $(this).val();
                                var precio = document.getElementById("precio_compra_abastecer").value;
                                var descuento = document.getElementById("descuento_compra_abastecer").value;
                                var resultado = ((parseFloat(precio)-parseFloat(descuento)) / parseFloat(cantidad)).toFixed(2);
                                document.getElementById("precio_unitario_abastecer").value = resultado;
                            });
                            $("#precio_compra_abastecer").on('keyup change',function() {
                                var cantidad = document.getElementById("cantidad_comprada_abastecer").value;
                                var precio = $(this).val();
                                var descuento = document.getElementById("descuento_compra_abastecer").value;
                                var resultado = ((parseFloat(precio)-parseFloat(descuento)) / parseFloat(cantidad)).toFixed(2);
                                document.getElementById("precio_unitario_abastecer").value = resultado;
                            });
                            //CALCULAMOS EL PRECIO UNITARIO, CUANDO CAMBIA EL DESCUENTO, DADO LA CANTIDAD
                            $("#descuento_compra_abastecer").on('keyup change',function() {
                                var cantidad = document.getElementById("cantidad_comprada_abastecer").value;
                                var precio = document.getElementById("precio_compra_abastecer").value;
                                var descuento = $(this).val();
                                var resultado = ((parseFloat(precio)-parseFloat(precio)*parseFloat(descuento)/100) / parseFloat(cantidad)).toFixed(2);
                                document.getElementById("precio_unitario_abastecer").value = resultado;
                            });
                        </script>