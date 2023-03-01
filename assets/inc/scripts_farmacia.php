        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>
        <!-- https://github.com/fabiorogeriosj/jquery-placeholder-label -->

        <!-- JQuery UI <script src="assets/libs/jquery/jquery-3.4.1.min.js"></script>-->
        <script src="assets/libs/jquery-ui/jquery-ui.min.js"></script>

        <!-- Required datatable js -->
        <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
        
        <!-- Buttons DataTables -->
        <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/vfs_fonts.js"></script>
        <script src="assets/libs/datatables/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables/buttons.print.min.js"></script>
        <script src="assets/libs/datatables/buttons.colVis.js"></script>

        <!-- Responsive examples -->
        <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Sweet Alerts js -->
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        
        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        

        <!--=============================  CLIENTES  =============================-->
        <script>
            $(document).ready(function() {
                //CARGAMOS LA TABLA DE CLIENTES
                $('#cliente_tabla').load('tabla_cliente.php');

                //COLOCAMOS EL FOCO EN EL PRIMER INPUT
                $('#modal_crear_cliente').on('shown.bs.modal',function(){
                    $('#cli_ci_nit').trigger('focus');
                });
            });

            $('#create_cliente').click(function(){
                valor1 = $('#cli_ci_nit').val();
                valor2 = $('#cli_nombre').val();
                valor3 = $('#cli_genero').val();
                valor4 = $('#cli_direccion').val();
                valor5 = $('#cli_celular').val();
                CrearCliente(valor1, valor2, valor3, valor4, valor5);
            });
            $('#update_cliente').click(function(){
                ActualizarCliente();
            });
            // 5.1 SI DAMOS CLIC EN EL BOTON CANCELAR DEL FORMULARIO DE REGISTRO DE DETALLE
            $('#cerrar_cliente').click(function(){
                    //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                    $('#formulario_crear_cliente')[0].reset();
            });
        </script>
        <!--=============================  LABORATORIOS  =============================-->
        <script>
            /* para cargar los clientes */
            $(document).ready(function() {
                //CARGAMOS TODOS LOS MEDICAMENTOS
                $('#laboratorio_tabla').load('tabla_laboratorio.php');
                //COLOCAMOS EL FOCO EN UN INPUT
                $('#modal_crear_laboratorio').on('shown.bs.modal',function(){
                    $('#lab_nombre').trigger('focus');
                });
            });

            $('#create_laboratorio').click(function(){
                valor1 = $('#lab_nombre').val();
                valor2 = $('#lab_nick').val();
                valor3 = $('#lab_direccion').val();
                valor4 = $('#lab_email').val();
                valor5 = $('#lab_web').val();
                valor6 = $('#lab_preventista').val();
                
                CrearLaboratorio(valor1, valor2, valor3, valor4, valor5, valor6);
            });
            $('#update_laboratorio').click(function(){
                ActualizarLaboratorio();
            });
            // 5.1 SI DAMOS CLIC EN EL BOTON CANCELAR DEL FORMULARIO DE REGISTRO DE DETALLE
            $('#cerrar_laboratorio').click(function(){
                //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                $('#formulario_crear_cliente')[0].reset();
            });


        </script>
        <!--=============================  VENTAS  =============================-->
        <script type="text/javascript">
            /*--===============================================================================================================
            =     1. COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO y REGISTRO DE UN PRODUCTOR EN LA TABLA DETALLE     =
            ================================================================================================================-*/
        
            // COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO INMEDIATAMENTE DESPUES DE ABRIR LA PAGINA venta.php
            $('#producto').focus();
            // CARGAMOS LA TABLA DETALLE DE COMPRA en el DIV con id=tabla_detalle, EL NUMERO DE FACTURA Y EL TOTAL.
            $(document).ready(function() {
                //CARGAMOS LA TABLA DETALLE DE LA FACTURA
                $('#tabla_detalle_factura').load('venta_tabla.php');
                //CARGAMOS EL NUMERO DE FACTURA
                $('#numero_factura').load('assets/inc/create_numero_factura.php');
                //CARGAMOS EL TOTAL DE LA FACTURA
                $('#total_factura').load('factura_total.php');
                $('#fac_total_cabecera').load('factura_total_cabecera.php');

            });

            // BUSCAMOS EL PRODUCTO A COMPRAR, Y MOTRAMOS SUS DATOS EN UN MODAL
            $(document).ready(function(){
                $("#producto").autocomplete({
                            source: function(request, response){
                                $.ajax({
                                    url: "autocomplete_producto.php",
                                    type: "post",
                                    dataType: "json",
                                    data: {search: request.term},
                                    success: function(data){
                                        response(data);
                                    }
                                });
                            },
                            minLength: 1,
                            select: function(event, ui){
                                event.preventDefault();
                                $('#prod_id').val(ui.item.id);
                                $('#prod_nombre').val(ui.item.nombre);
                                $('#prod_stock').val(ui.item.stock);
                                $('#prod_precio_compra').val(ui.item.precio_compra);
                                $('#prod_precio_venta').val(ui.item.precio_venta);

                                $('#prod_codigo').val(ui.item.codigo);
                                $('#prod_forma').val(ui.item.forma);
                                $('#prod_caducidad').val(ui.item.caducidad);
                                //ABRE VENTANA MODAL...(CON DATOS DEL PRODUCTO SELECCIONADO)
                                $('#modal_crear_detalle').modal("show");
                                return false;
                            }
                });
            });
            //--------------------------------------------------------------------------------------------------------------------------------------//   
            //2. COLOCA EL FOCO EN EL INPUT CANTIDAD A COMPRAR SOLO SI HAY STOCK DISPONIBLE, DESPUES DE CARGAR EL MODAL CREAR DETALLE
            $(document).ready(function() {
                //COLOCAMOS EL FOCO EN EL INPUT DE CANTIDAD A COMPRAR, DESPUES DE ABRIR EL MODAL CREAR DETALLE
                //DEPENDIENDO SI HAY STOCK DISPONIBLE, SI EL STOCK ES MAYOR A 0 ENTONCES SE PONE EL FOCO, SI NO NÓ.
                $('#modal_crear_detalle').on('shown.bs.modal',function(){
                    //SI EL STOCK ES CERO, NO SE PUEDE COMPRAR ESE PRODUCTO, POR TANTO EL VALUE MINIMO DE CANTIDAD A COMPRAR SERA 0, CASO CONTRARIO 1
                    stock = parseInt($('#prod_stock').val());
                    if (stock > 0) {
                        //COLOCAMOS EL VALOR DEL SUB TOTAL AL ABRIR EL MODAL, DONDE MUESTRA EN CANTIDAD UN PRODUCTO Y SIN DESCUENTO
                        //ESTO ES SOLO PARA CUANDO SE ABRE EL MODAL.
                        $('#prod_cantidad').val(1);
                        var valor = $("#prod_cantidad").removeAttr("readonly");
                        document.getElementById("prod_subtotal").value = parseFloat($('#prod_cantidad').val())*parseFloat($('#prod_precio_venta').val());
                        //AL ATRIBUTO MAX DEL INPUT con id=prod_cantidad SE ASIGNACION EL VALOR DEL STOCK
                        //ESO QUIERE DECIR QUE NO SE PUEDE COMPRAR MAS QUE ES STOCK DISPONIBLE
                        var input = document.getElementById("prod_cantidad");
                        input.setAttribute("max",stock); // set a new value;
                        //COLOCAMOS EL FOCO EN EL INPUT CANTIDAD A COMPRAR
                        $('#prod_cantidad').focus();

                    }else{//SI EL STOCK ES CERO...
                        //SETEAMOS EL VALUE DE CANTIDAD A COMPRAR A CERO y DE SOLO LECTURA
                        $('#prod_cantidad').val(0);
                        var valor = $("#prod_cantidad").attr("readonly","readonly");
                        //SI EL STOCK ES CERO, ENTONCES EL SUB TOTAL ES CERO
                        document.getElementById("prod_subtotal").value = 0;
                        //AL ATRIBUTO MAX DEL INPUT con id=prod_cantidad SE ASIGNACION EL VALOR DEL STOCK
                        //ESO QUIERE DECIR QUE NO SE PUEDE COMPRAR MAS QUE ES STOCK DISPONIBLE
                        //var input = document.getElementById("prod_cantidad");
                        //input.setAttribute("max",0); // set a new value;
                    }
                });
            });
            //--------------------------------------------------------------------------------------------------------------------------------------//   
            //3. CALCULA EL SUBTOTAL DADO LA CANTIDAd A COMPRAR y EL DESCUENTO
            $('#prod_cantidad').on('keyup change',function() {
            //$('#prod_cantidad').keyup(function() {
                var cantidad = $(this).val();

                pc = parseFloat($('#prod_precio_compra').val());
                pv = parseFloat($('#prod_precio_venta').val());
                desc = parseFloat($('#prod_descuento').val());
                utilidad = (parseFloat(pv)-parseFloat(pc)).toFixed(2);
                // SUBTOTAL = CANTIDAD * (PRECIOdeCOMPRA + (UTILIDAD - UTILIDAD/100))
                subtotal = (parseFloat(cantidad)*((parseFloat(pc)+(parseFloat(utilidad)-parseFloat(utilidad)*(parseFloat(desc)/100))))).toFixed(2);
                //$('#prod_subtotal').text(subtotal);
                $('#prod_subtotal').val(subtotal);

              }).keyup();

            $('#prod_descuento').on('keyup change',function(){
            //$('#prod_cantidad').keyup(function() {
                var descuento = $( this ).val();
                //$( "p" ).text( cantidad );
                //porcentaje del valor total para precios de ventas
                cantidad = parseFloat($('#prod_cantidad').val());
                pc = parseFloat($('#prod_precio_compra').val());
                pv = parseFloat($('#prod_precio_venta').val());
                desc = parseFloat(descuento);
                utilidad = (parseFloat(pv)-parseFloat(pc)).toFixed(2);
                subtotal = (parseFloat(cantidad)*((parseFloat(pc)+(parseFloat(utilidad)-parseFloat(utilidad)*(parseFloat(desc)/100))))).toFixed(2);

                //$('#subtotal').text(subtotal);
                $('#prod_subtotal').val(subtotal);
            }).keyup();
            //--------------------------------------------------------------------------------------------------------------------------------------//   
            //4. ASIGNACION DE HotKey A LOS BOTONES USANDO JavaSCcript
            document.addEventListener('keyup', event => {
                // combinación de teclas ctrl + a        http://keycode.info/
                /*if (event.ctrlKey && event.keyCode === 65) {
                    document.getElementById("create_detalle").click();
                }*/
                if (event.keyCode === 13) {//13 tecla enter
                    document.getElementById("create_detalle").click();
                    //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                    $('#formulario_buscar_producto')[0].reset();
                    //LIMPIA EL MODAL PARA REGISTRAR PRODUCTO
                    $('#modal_crear_detalle').on('hidden.bs.modal',function(){
                        $(this).find('#formulario_crear_detalle')[0].reset();
                    });
                    //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                    $('#producto').focus();
                }
                else if (event.keyCode === 27) {//27 tecla escape
                    document.getElementById("create_cerrar").click();
                    //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                    $('#formulario_buscar_producto')[0].reset();
                    //LIMPIA EL MODAL PARA REGISTRAR PRODUCTO
                    $('#modal_crear_detalle').on('hidden.bs.modal',function(){
                        $(this).find('#formulario_crear_detalle')[0].reset();
                    });
                    //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                    $('#producto').focus();
                }
            }, false);
            //--------------------------------------------------------------------------------------------------------------------------------------//   
            //5. REGISTRA UN PRODUCTO EN LA TABLA DETALLE DE COMPRA DE LA FACTURA
            $('#create_detalle').click(function(){
                valor1 = parseInt($('#fac_id').val());
                valor2 = $('#prod_id').val();
                valor3 = $('#prod_nombre').val();
                valor4 = $('#prod_cantidad').val();
                valor5 = parseInt($('#prod_stock').val())-parseInt($('#prod_cantidad').val());//STOCK ACTUALIZADO
                valor6 = $('#prod_precio_venta').val();
                //EL SUBTOTAL Y UTILIDAD SE PUEDE COPIAR DIRECTAMENTE DE LOS INPUTS, YA QUE EL CALCULO SE REALIZA
                //MAS ARRIBA CUANDO LA CANTIDAD Y DESCUENTO CAMBIAN....
                //valor7 = (parseFloat($('#prod_cantidad').val())*parseFloat($('#prod_precio_venta').val())).toFixed(2);//SUB TOTAL
                //valor8 = (parseFloat($('#prod_cantidad').val())*(parseFloat($('#prod_precio_venta').val())-parseFloat($('#prod_precio_compra').val()))).toFixed(2);//UTILIDAD
                valor7 = parseFloat($('#prod_subtotal').val());//SUB TOTAL
                valor8 = (parseFloat($('#prod_subtotal').val())-(parseFloat($('#prod_cantidad').val())*parseFloat($('#prod_precio_compra').val()))).toFixed(2);//UTILIDAD
                valor9 = $('#prod_codigo').val();
                CrearDetalle(valor1, valor2, valor3, valor4, valor5, valor6, valor7, valor8, valor9);
                    //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                    $('#formulario_buscar_producto')[0].reset();
                    //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                    //$('#producto').trigger('focus');
                    $('#producto').focus();
            });
            // 5.1 SI DAMOS CLIC EN EL BOTON CANCELAR DEL FORMULARIO DE REGISTRO DE DETALLE
            $('#cerrar_detalle').click(function(){
                    //LIMPIA EL FORMULARIO DE BUSQUEDA DE PRODUCTO
                    $('#formulario_buscar_producto')[0].reset();
                    //COLOCAMOS EL FOCO EN EL INPUT PARA BUSCAR UN PRODUCTO
                    //$('#producto').trigger('focus');
                    $('#producto').focus();
            });


            //AUTOCOMPLETA DATOS DEL CLIENTE DADO EL CI ó NIT
            $(document).ready(function(){
                $("#fac_ci_nit").autocomplete({
                        source: "autocomplete_factura_ci_nit.php",
                        minLength: 2,
                        select: function(event, ui) {
                            event.preventDefault();
                            $('#cli_id').val(ui.item.id);
                            $('#fac_ci_nit').val(ui.item.ci_nit);
                            $('#fac_nombre').val(ui.item.nombre);
                        }
                });
            });

            //AUTOCOMPLETA DATOS DEL CLIENTE DADO EL NOMBRE
            $(document).ready(function(){
                $("#fac_nombre").autocomplete({
                        source: "autocomplete_factura_nombre.php",
                        minLength: 2,
                        select: function(event, ui) {
                            event.preventDefault();
                            $('#cli_id').val(ui.item.id);
                            $('#fac_ci_nit').val(ui.item.ci_nit);
                            $('#fac_nombre').val(ui.item.nombre);
                        }
                });
            });

            //CALCULA EL CAMBIO, DADO EL TOTAL DE LA FACTURA
            $(document).ready(function () {
                $("#fac_importe").keyup(function () {
                    var total = document.getElementById("fac_total").value;
                    var importe = $(this).val();
                    var cambio = (parseFloat(importe) - parseFloat(total)).toFixed(2);
                    document.getElementById("fac_cambio").value = cambio;
                });
            });


            //REGISTRAMOS LA FACTURA Y CON ESTO CONCLUYE LA VENTA
            $('#create_factura').click(function(){
                //RECARGAMOS LA TABLA DETALLE
                //$('#tabla_detalle').load('pos_tabla.php');
                //RECARGAMOS EL TOTAL DE LA FACTURA
                //$('#total_factura').load('factura_total.php');

                valor1 = parseInt($('#fac_id').val());
                valor2 = $('#cli_id').val();
                valor3 = $('#fac_nombre').val();
                valor4 = $('#user_id').val();
                valor5 = $('#fac_usuario').val();
                valor6 = $('#fac_total').val();
                CrearFactura(valor1, valor2, valor3, valor4, valor5, valor6);
                
            });
        </script>
