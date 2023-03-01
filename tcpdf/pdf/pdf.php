<?php
date_default_timezone_set('America/La_Paz');
require_once "../../../modelos/solicitud.compra.material.modelo.php";
require_once "../../../controladores/funciones.controlador.php";

class ImprimirReporte{

public $codigo;

public function traerImpresionSolicitudCompra(){
error_reporting(0);  
$codigo = $this->codigo;
$Solicitud = ProcesoSolicitudCompra::ListaDetalleSolicitudCompraModelo($codigo);
// $Venta = ModeloVentas::mdlMostrarAdmVentasDetalle($IdVenta);
setlocale(LC_TIME, "spanish");			
$date = strftime("%A %d de %B del %Y");	

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF
<hr>
	<table>
			<tr>
				<td style="width:100px"><img style="height:70px;" src="images/1.jpg"></td>
				<td style="width:345px; color:white;">
					<div style="color: #212121; font-weight: bold; font-size:15px; text-align:center; line-height:20px;">EMPRESA DE DISTRIBUCION DE ENERGIA ELECTRICA CARACOLLO S.A.</div>
					
					<div style="color: #212121; font-weight: bold; font-size:10px; text-align:center; line-height:8px;">CARACOLLO - ORURO - BOLIVIA</div>
				</td>
				<td style="width:100px;"><img style="height:70px;" src="images/2.jpg"></td>
			</tr>
		</table>
	<hr width="100%" />

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
$bloque3 = <<<EOF

		
		<table>
		<tr>
<td style="background-color:white; width:540px; text-align:center; color:red"><br><br>SOLICITUD DE MATERIAL DE ALMACEN Nº: $codigo<br>$valorVenta</td>
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>
	</table>

	<table style="font-size:10px; padding:5px 10px;">
	

		<tr>
		<td style="border: 1px solid #666; background-color:white; width:540px">Para: CIPRIAN CATARI</td>
		</tr>
		<tr>
		<td style="border: 1px solid #666; background-color:white; width:540px">Fecha: 21 de noviembre de 2019</td>
		</tr>
		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>
	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">Unidad</td>
		<td style="border: 1px solid #666; background-color:white; width:240px; text-align:center">Descripcion Material</td>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');


foreach($Solicitud as $row => $item){
	// $subtotal = $item[DVPrecioVenta] * $item[DVCantidad];
$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">$item[scm_cantidad]</td>
		<td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">$item[unid_nombre]</td>
		<td style="border: 1px solid #666; background-color:white; width:240px; text-align:center">$item[mat_nombre]</td>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

$pdf->Output('pdf.php');

}

}

$a = new ImprimirReporte();
$a -> codigo = $_GET["codigo"];
$a -> traerImpresionSolicitudCompra();

 ?>
 