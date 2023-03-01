                <?php
                include('assets/inc/conexion.php');
                //OBTENEMOS EL BARCODE DEL PRODUCTO DEL CUAL OBTENEMOS SUS DATOS
                $sql = "SELECT prod_barcode FROM configuracion";
                $row = mysqli_fetch_row(mysqli_query($conexion,$sql));
                $prod_barcode = $row[0];
                //OBTENEMOS LOS DATOS DEL PRODUCTO DADO SU CODIGO DE BARRAS
                $consulta = "SELECT * FROM producto WHERE prod_barcode LIKE '%$prod_barcode%'";
                if ($resultado = mysqli_query($conexion, $consulta)) {
                    $fila = mysqli_fetch_row($resultado);
                ?>
                <form class="form-horizontal" id="formulario_crear_detalle_barcode">
                    <!--=================================
                    =  DATOS DEL PRODUCTO SELECCIONADO  =
                    ==================================-->
                    <div class="form-row">
                        <div class="form-group col-sm-8">
                            <label class="col-form-label">Nombre Comercial</label>
                            <input type="hidden" class="form-control" readonly="" id="prod_id" name="prod_id" value="<?php echo $fila[0]; ?>">
                            <input type="text" class="form-control" readonly="" id="prod_nombre" name="prod_nombre" value="<?php echo $fila[1]; ?>" style="background-color:#EBF9D6;">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="col-form-label">Precio</label>
                            <input type="hidden" class="form-control" readonly="" id="prod_precio_compra" name="prod_precio_compra" value="<?php echo $fila[15]; ?>">
                            <input type="text" class="form-control" readonly="" id="prod_precio_venta" name="prod_precio_venta" value="<?php echo $fila[16]; ?>" style="background-color:#EBF9D6;">
                        </div>
                        <div class="form-group col-sm-2">
                            <label class="col-form-label">Stock</label>
                            <input type="text" class="form-control" readonly="" id="prod_stock" name="prod_stock" value="<?php echo $fila[14]; ?>" style="background-color:#EBF9D6;">
                        </div>

                        <div class="form-group col-sm-3">
                            <label class="col-form-label">Código</label>
                            <input type="text" class="form-control" readonly="" id="prod_codigo" name="prod_codigo" value="<?php echo $fila[10]; ?>">
                        </div>
                        <div class="form-group col-sm-5">
                            <label class="col-form-label">Forma</label>
                            <input type="text" class="form-control" readonly="" id="prod_forma" name="prod_forma" value="<?php echo $fila[3]; ?>">
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="col-form-label">Caducidad</label>
                            <input type="text" class="form-control" readonly="" id="prod_caducidad" name="prod_caducidad" value="<?php echo $fila[13]; ?>">
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="col-form-label">Cantidad</label>
                            <input type="number" min="1" step="1" class="form-control" id="prod_cantidad" name="prod_cantidad" value="">
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="col-form-label">Descuento</label>
                            <div class="input-group">
                                <input type="number" value="0" min="0" max="100" step="10" class="form-control" id="prod_descuento" name="prod_descuento">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="col-form-label">Sub Total</label>
                            <div class="input-group">
                                <input type="text" class="form-control" readonly="" id="prod_subtotal" name="prod_subtotal" value="0">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bs</span>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" readonly="" id="prod_utilidad" name="prod_utilidad" value="0">
                        </div>
                    </div>
                </form>
                <?php
                    }
                ?>
                <script>
                    $('#prod_cantidad').on('keyup change',function() {
                        var cantidad = $(this).val();

                        pc = parseFloat($('#prod_precio_compra').val());
                        pv = parseFloat($('#prod_precio_venta').val());
                        descuento = parseFloat($('#prod_descuento').val());
                        util = (parseFloat(pv)-parseFloat(pc)).toFixed(2);
                        // SUBTOTAL = CANTIDAD * (PRECIO_COMPRA + (UTILIDAD - UTILIDAD*DESCUENTO/100))
                        subtotal = (parseFloat(cantidad)*((parseFloat(pc)+(parseFloat(util)-parseFloat(util)*(parseFloat(descuento)/100))))).toFixed(2);
                        utilidad = (parseFloat(cantidad)*((parseFloat(util)-parseFloat(util)*(parseFloat(descuento)/100)))).toFixed(2);
                        // UTILIDAD = CANTIDAD * (UTILIDAD - UTILIDAD*DESCUENTO/100)
                        $('#prod_subtotal').val(subtotal);
                        $('#prod_utilidad').val(utilidad);

                      });

                    $('#prod_descuento').on('keyup change',function(){
                        var descuento = $( this ).val();
                        //$( "p" ).text( cantidad );
                        //porcentaje del valor total para precios de ventas
                        pc = parseFloat($('#prod_precio_compra').val());
                        pv = parseFloat($('#prod_precio_venta').val());
                        cantidad = parseFloat($('#prod_cantidad').val());
                        util = (parseFloat(pv)-parseFloat(pc)).toFixed(2);

                        subtotal = (parseFloat(cantidad)*((parseFloat(pc)+(parseFloat(util)-parseFloat(util)*(parseFloat(descuento)/100))))).toFixed(2);
                        utilidad = (parseFloat(cantidad)*((parseFloat(util)-parseFloat(util)*(parseFloat(descuento)/100)))).toFixed(2);

                        //$('#subtotal').text(subtotal);
                        $('#prod_subtotal').val(subtotal);
                        $('#prod_utilidad').val(utilidad);

                    }).keyup();
                </script>