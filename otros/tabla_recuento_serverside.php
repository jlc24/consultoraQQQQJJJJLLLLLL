        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function (){
                var table = $('#medicamento').dataTable({
                    responsive: true,
                    columnDefs: [{
                        "targets": -1,
                        //https://codebeautify.org/htmlviewer/
                        //"defaultContent": "<div class='dropup dropleft'><button type='button' class='btn btn-icon btn-xs btn-outline-purple dropdown-toggle' data-toggle='dropdown'><i class='fas fa-caret-down'></i></button><div class='dropdown-menu'><a href='javascript:void(0);' class='dropdown-item' title='Editar' data-toggle='modal' data-target='#modal_editar_medicamento'><i class='far fa-edit btnEditar'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Eliminar'><i class='far fa-trash-alt btnBorrar'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Abastecer' data-toggle='modal' data-target='#modal_abastecer_medicamento'><i class='fas fa-shopping-bag btnAbastecer'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Historial' data-toggle='modal' data-target='#modal_historial_compra'><i class='fas fa-list-ol btnHistorial'></i></a></div></div>"
                        "defaultContent": "<a href='javascript:void(0);' data-toggle='modal' data-target='#modal_actualizar_recuento' title='Actualizar Stock'><i style='color: purple; --darkreader-inline-color:#230443; font-size:20px;' class='icon-note btnRecuento' data-darkreader-inline-color=''></i></a>"
                    }],
                    "order": [[7, "desc"]],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "serverside_recuento.php",
                    "lengthMenu":[15,25,50,100],
                    "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
                //MUESTRA LA Version DE NUESTRO DataTable
                //var versionNo = $.fn.dataTable.version;
                //alert(versionNo);
                //var table = $('#medicamento').DataTable();
                $('#medicamento_filter input').focus();
            });
        </script>

        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php'); ?>

        <div class="row justify-content-center">
            <form class="form-inline">
                <label class="mb-2 mr-sm-2">VENDEDOR :</label>
                <select class="form-control mb-2 mr-sm-2" id="lab_nombre" name="lab_nombre">
                    <option value=""> -- SELECCIONAR -- </option>
                    <?php
                        $sql="SELECT DISTINCT prod_nicklaboratorio FROM producto";
                        $resultado=mysqli_query($conexion,$sql);
                        while($nombre_lab = mysqli_fetch_row($resultado)){//mientras haya filas (nombres de laboratorios) a recorrer
                        echo '<option value="'.$nombre_lab[0].'">'.$nombre_lab[0].'</option>';
                        }
                    ?>
                </select>
                <button type="button" id="button_lab" class="btn btn-purple mb-2">BUSCAR...</button>
            </form>
        </div>
        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <table id="medicamento" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="1">ID</th>
                <th data-priority="2">Código</th>
                <th data-priority="4">Nombre Comercial</th>
                <th data-priority="8">Forma</th>
                <!--<th data-priority="9">Principio Activo</th>-->
                <th data-priority="7">Laboratorio</th>
                <th data-priority="10">Caducidad</th>
                <th data-priority="5">Stock</th>
                <!--<th data-priority="11">Ubicación</th>-->
                <th data-priority="6">Fecha Actualización</th>
                <th data-priority="12">P.Compra</th>
                <th data-priority="13">Inversión</th>
                <th data-priority="3">Op</th>
            </thead>
        </table>

