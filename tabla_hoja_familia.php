        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=hoja-->
        <script type="text/javascript">
            $(document).ready(function (){
                var table = $('#hoja').dataTable({
                    responsive: true,
                    columnDefs: [{
                        "targets": -1,
                        //https://codebeautify.org/htmlviewer/
                        //"defaultContent": "<div class='dropup dropleft'><button type='button' class='btn btn-icon btn-xs btn-outline-purple dropdown-toggle' data-toggle='dropdown'><i class='fas fa-caret-down'></i></button><div class='dropdown-menu'><a href='javascript:void(0);' class='dropdown-item' title='Editar' data-toggle='modal' data-target='#modal_editar_hoja'><i class='far fa-edit btnEditar'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Eliminar'><i class='far fa-trash-alt btnBorrar'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Abastecer' data-toggle='modal' data-target='#modal_abastecer_hoja'><i class='fas fa-shopping-bag btnAbastecer'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Historial' data-toggle='modal' data-target='#modal_historial_compra'><i class='fas fa-list-ol btnHistorial'></i></a></div></div>"
                        //"defaultContent": "<div class='dropup dropleft'><button type='button' class='btn btn-icon btn-xs btn-outline-purple dropdown-toggle' data-toggle='dropdown'><i class='fas fa-caret-down'></i></button><div class='dropdown-menu'><a href='javascript:void(0);' class='dropdown-item' title='Editar' data-toggle='modal' data-target='#modal_editar_hoja'><i class='far fa-edit btnEditar'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Eliminar'><i class='far fa-trash-alt btnBorrar'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Abastecer' data-toggle='modal' data-target='#modal_abastecer_hoja'><i class='fas fa-shopping-bag btnAbastecer'></i></a><a href='javascript:void(0);' class='dropdown-item' title='Historial' data-toggle='modal' data-target='#modal_historial_compra'><i class='fas fa-list-ol btnHistorial'></i></a></div></div>"
                        //"defaultContent": "<a href='javascript:void(0);' data-toggle='modal' data-target='#modal_actualizar_nota' title='Actualizar Hoja de Ruta'><i style='color: purple; --darkreader-inline-color:#230443; font-size:20px;' class='icon-note btnEditarHoja' data-darkreader-inline-color=''></i></a>&nbsp;&nbsp;<a href='javascript:void(0);' data-toggle='modal' data-target='#modal_crear_evento_hoja' title='Registrar Actividad en la Hoja de Ruta'><i style='color: purple; --darkreader-inline-color:#230443; font-size:20px;' class='icon-action-redo btnEventoHoja' data-darkreader-inline-color=''></i></a>&nbsp;&nbsp;<a href='javascript:void(0);' data-toggle='modal' data-target='#modal_detalle_hoja' title='Historial de la Hoja de Ruta'><i style='color: purple; --darkreader-inline-color:#230443; font-size:20px;' class='icon-book-open btnDetalleHoja' data-darkreader-inline-color=''></i></a>&nbsp;&nbsp;<a href='tcpdf/pdf/hoja_ruta.php' target='_blank' title='Imprimir Hoja de Ruta'><i style='color: purple; --darkreader-inline-color:#230443; font-size:20px;' class='far fa-file-pdf btnImprimirHoja' data-darkreader-inline-color=''></i></a>"
                        "defaultContent": "<a href='javascript:void(0);' data-toggle='modal' data-target='#modal_crear_evento_hoja' title='Registrar Actividad en la Hoja de Ruta'><i style='color: purple; --darkreader-inline-color:#230443; font-size:20px;' class='icon-action-redo btnEventoHoja' data-darkreader-inline-color=''></i></a>&nbsp;&nbsp;<a href='javascript:void(0);' data-toggle='modal' data-target='#modal_detalle_hoja' title='Historial de la Hoja de Ruta'><i style='color: purple; --darkreader-inline-color:#230443; font-size:20px;' class='icon-book-open btnDetalleHoja' data-darkreader-inline-color=''></i></a>&nbsp;&nbsp;<a href='tcpdf/pdf/hoja_ruta.php' target='_blank' title='Imprimir Hoja de Ruta'><i style='color: purple; --darkreader-inline-color:#230443; font-size:20px;' class='far fa-file-pdf btnImprimirHoja' data-darkreader-inline-color=''></i></a>"
                        
                    }],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "serverside_familia.php",
                    "lengthMenu":[5,10,15,20],
                    "order": [[ 0,"desc" ]],//ORDERNAR DESCENDENTEMENTE POR EL ID DE LA HOJA DE RUTA
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
            <thead style="background-color: #C6C6C6;">
                <th data-priority="1">ID</th>
                <th data-priority="2">Cliente</th>
                <th class="none">CI Cliente</th>
                <th class="none">Celular Cliente</th>
                <th class="none">Fecha Ingreso</th>
                <th data-priority="3">Patrocinio</th>
                <th data-priority="5">Tipo de Proceso</th>
                <th data-priority="6">Juzgado Público de Familia</th>
                <th data-priority="7">NUREJ</th>
                <th class="none">Etapa del Proceso</th>
                <th data-priority="4">Opcciones</th>
            </thead>
        </table>

        <!--=============================  FILTER MULTIPLE COLUMNS  
        
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
        </script>  =============================-->