        <!-- INICIALIZAMOS EL PLUGIN Datatables EN LA TABLA CON id=medicamento-->
        <script type="text/javascript">
            $(document).ready(function (){
                var table = $('#vademecum').dataTable({
                    responsive: true,
                    columnDefs: [],
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "serverside_vademecum.php",
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
                //var versionNo = $.fn.dataTable.version;
                //alert(versionNo);
                //var table = $('#vademecum').DataTable();
                $('#vademecum_filter input').focus();
            });
        </script>

        <!--=================================================
        =            CONEXION A LA BASE DE DATOS            =
        ==================================================-->
        <?php include('assets/inc/conexion.php'); ?>

        <table id="vademecum" class="table mb-0 table-sm table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #DBEDC8;">
                <th data-priority="1">Nombre Comercial</th>
                <th data-priority="2">Forma Medicamentosa</th>
                <th data-priority="4">Categoria Terapéutica</th>
                <th data-priority="5">Principio Activo (Nombre Genérico)</th>
                <th data-priority="3">Laboratorio</th>
                <th class="none">Forma farmacéutica y formulación : </th>
                <th class="none">Descripción : </th>
                <th class="none">Indicaciones terapeúticas : </th>
                <th class="none">Contraindicaciones : </th>
                <th class="none">Reacciones secundarias y adversas : </th>
                <th class="none">Dosis y vía de administración : </th>
                <th class="none">Presentaciones : </th>
            </thead>
        </table>

