        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function (){
                var table = $('#medicamento').dataTable({
                    responsive: true,
                    columnDefs: [{
                        "targets": -1,
                        //https://codebeautify.org/htmlviewer/
                        "defaultContent": "<a href='javascript:void(0);' data-toggle='modal' data-target='#modal_actualizar_recuento' title='Historial de Ventas'><i style='color: purple; --darkreader-inline-color:#230443; font-size:20px;' class='icon-chart btnHistorial' data-darkreader-inline-color=''></i></a>"
                    }],
                    "order": [[7, "desc"]],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "serverside_producto_top.php",
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
        <!--====  End of CONEXION A LA BASE DE DATOS  ====-->

        <!--<h4 class="header-title">Buttons example</h4>
        <p class="sub-header">
            The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
        </p>-->

        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <table id="medicamento" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="1">ID</th>
                <th data-priority="5">Código</th>
                <th data-priority="2">Nombre Comercial</th>
                <th data-priority="7">Categoria Terapéutica</th>
                <th data-priority="6">Forma</th>
                <th data-priority="8">Principio Activo</th>
                <th data-priority="9">Laboratorio</th>
                <th data-priority="3">Cantidad Vendida</th>
                <th data-priority="4">Op.</th>
            </thead>
        </table>

