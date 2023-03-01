        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=hoja-->
        <script type="text/javascript">
            $(document).ready(function (){
                var table = $('#hoja').dataTable({
                    responsive: true,
                    columnDefs: [{
                        "targets": -1,
                        //https://codebeautify.org/htmlviewer/
                        //"defaultContent": "<div class='dropup dropleft'><button type='button' class='btn btn-icon btn-xs btn-outline-purple dropdown-toggle' data-toggle='dropdown'><i class='fas fa-caret-down'></i></button><div class='dropdown-menu'><a href='javascript:void(0);' class='dropdown-item' title='Editar' data-toggle='modal' data-target='#modal_editar_hoja'><i class='far fa-edit btnEditar'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Eliminar'><i class='far fa-trash-alt btnBorrar'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Abastecer' data-toggle='modal' data-target='#modal_abastecer_hoja'><i class='fas fa-shopping-bag btnAbastecer'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Historial' data-toggle='modal' data-target='#modal_historial_compra'><i class='fas fa-list-ol btnHistorial'></i></a></div></div>"
                        "defaultContent": "<div class='dropup dropleft'><button type='button' class='btn btn-icon btn-xs btn-outline-purple dropdown-toggle' data-toggle='dropdown'><i class='fas fa-caret-down'></i></button><div class='dropdown-menu'><a href='javascript:void(0);' class='dropdown-item' title='Editar' data-toggle='modal' data-target='#modal_editar_hoja'><i class='far fa-edit btnEditar'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Eliminar'><i class='far fa-trash-alt btnBorrar'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Abastecer' data-toggle='modal' data-target='#modal_abastecer_hoja'><i class='fas fa-shopping-bag btnAbastecer'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Historial' data-toggle='modal' data-target='#modal_historial_compra'><i class='fas fa-list-ol btnHistorial'></i></a></div></div>"
                    }],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "serverside_hoja.php",
                    "lengthMenu":[15,25,50,100],
                    "order": [[ 1,"desc" ]],//ORDERNAR DESCENDENTEMENTE POR EL ID DE LA HOJA DE RUTA
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
                //var table = $('#hoja').DataTable();
                $('#hoja_filter input').focus();
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

        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=hoja-->
        <table id="hoja" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="1">ID</th>
                <th data-priority="2">N° Trámite</th>
                <th data-priority="4">Solicitante</th>
                <th data-priority="5">C.I.</th>
                <th data-priority="6">Celular</th>
                <th data-priority="7">Fecha Ingreso</th>
                <th data-priority="8">Fecha Salida</th>
                <th data-priority="12">Área</th>
                <th data-priority="9">Responsable</th>
                <th class="none">Observación</th>
                <th data-priority="11">Fecha Finalización</th>
                <th data-priority="3">Op.</th>
            </thead>
        </table>

        <!--=============================  FILTER MULTIPLE COLUMNS  =============================-->
        <script>
            $(document).ready(function ()
            {
                // Setup - add a text input to each header cell
                $('#hoja thead th').each(function() {
                    var title = $(this).text();
                    $(this).html(title + ' <input type="text" class="col-search-input" placeholder="&#xF002;" />');
                });

                // DataTable
                var otable = $('#hoja').DataTable();

                // Apply the search
                otable.columns().every(function() {

                    var that = this;
                    $('input', this.header()).on('keyup change', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            });
        </script>