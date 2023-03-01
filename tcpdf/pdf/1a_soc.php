<?php
date_default_timezone_set('America/La_Paz');

class Conexion
{
	static public function Conectar()
	{
		$link = new PDO("mysql:host=localhost;dbname=kantuta2", "root", "usbw");
		return $link;
	}
}

class ImprimirReporte
{
	public $codigo;
	public function Consulta()
	{
		$stmt = Conexion::Conectar()->prepare("SELECT *FROM calificacion2021 WHERE cal_curso = '1A' AND cal_materia = 'SOC' AND cal_trimestre  = '3'");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null;
	}
	public function traerImpresionSolicitudCompra()
	{
		error_reporting(0);
		$codigo = $this->codigo;
		setlocale(LC_TIME, "spanish");
		$date = strftime("%A %d de %B del %Y");

		$a = ImprimirReporte::Consulta();
// ESTILOS 
		$colordmv = '#2E2E2E';
		$colorlight = '#F8F9FA';
		$styleth = 'padding: 1px; text-align: center; border: 1px solid ' . $colordmv . '; background-color:' . $colordmv . '; font-weight: bold; color:white;';
		$styletd = 'padding: 1px; text-align: center; border: 1px solid ' . $colordmv . '; background-color:' . $colorlight . '; font-weight: bold; color:black;';
		require_once('tcpdf_include.php');

//Add a custom size  
//$width = 216;  
//$height = 279; 
//$orientation = ($height>$width) ? 'P' : 'L';  
//$pdf->addFormat("custom", $width, $height);  
//$pdf->reFormat("custom", $orientation);  

		$pageLayout = array(216, 279); //  or array($height, $width) 

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $pageLayout, true, 'UTF-8', false);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP - 20, PDF_MARGIN_RIGHT);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM - 20);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->startPageGroup();

		$pdf->AddPage();

// ---------------------------------------------------------

		$bloque1 = <<<EOF
<table>
	<tr>
		<td style="width:100px">
			<img style="height:70px;" src="images/K2.png">
		</td>
		<td style="width:345px; color:white;">
			<div style="color: red; font-weight: bold; font-size:15px; text-align:center; line-height:20px;">REGISTRO DE CALIFICACIONES</div>
			<div style="color: red; font-weight: bold; font-size:12px; text-align:center; line-height:8px;">UNIDAD EDUCATIVA LA KANTUTA "2"</div>
		</td>
	</tr>
</table>

EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
		$tbl = <<<EOD
<table border="0" style="font-size:10px; padding:3px 5px; border-collapse: collapse; border-radius:10px" >
	<tr>
		<th colspan="2" ></th>
		<th colspan="8" ><strong>AREA:</strong> CIENCIAS SOCIALES </th>
		<th colspan="9" ><strong>DOCENTE:</strong> ALANES FUENTES ANGELICA </th>
	</tr>
	<tr>
		<th colspan="2" ></th>
		<th colspan="8" ><strong>CURSO:</strong> PRIMERO "A" </th>
		<th colspan="9" ><strong>GESTIÓN:</strong> 2021 </th>
	</tr>

EOD;

		$pdf->writeHTML($tbl, true, false, false, false, '');

		$bloque3 = <<<EOF

		<table border="1" style="font-size:9px; padding:1px 5px; border-collapse: collapse; border-radius:10px;text-align:center">
			<tr>
				<th style="vertical-align:middle" colspan="1" rowspan="2"><br><br><br><br><br>Nº</th>
				<th style=\"align-content: center;\" colspan="7" rowspan="2"><br><br><br><br><br>NÓMINA DE ALUMNOS</th>
				<th rowspan="2" style="background-color:#E2F4FB"><p style="writing-mode: vertical-lr; transform: rotate(180deg);"><br>S<br>E<br>R</p></th>
				<th colspan="4" style="background-color:#E2F4FB">SABER - 35</th>
				<th colspan="4" style="background-color:#E2F4FB">HACER - 35</th>
				<th rowspan="2" style="background-color:#E2F4FB">D<br>E<br>C<br>I<br>D<br>i<br>R</th>
				<th rowspan="2" style="background-color:#E2F4FB">E<br>V<br>A<br>L<br>U<br>A<br>C<br>I<br>Ó<br>N</th>
				<th rowspan="2" style="background-color:#E2F4FB">S<br>E<br>R</th>
				<th rowspan="2" style="background-color:#E2F4FB">D<br>E<br>C<br>I<br>D<br>I<br>R</th>
				<th rowspan="2" style="background-color:#E2F4FB">A<br>U<br>T<br>O<br>E<br>V<br>A<br>L</th>
				<th rowspan="2" style="background-color:#C5EAF8">N<br>O<br>T<br>A<br><br>3<br>T</th>
			</tr>
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th style="background-color:#E2F4FB"><br>P<br>R<br>O<br>M<br>E<br>D<br>I<br>O</th>
				<th></th>
				<th></th>
				<th></th>
				<th style="background-color:#E2F4FB"><br>P<br>R<br>O<br>M<br>E<br>D<br>I<br>O</th>
			</tr>
		</table>

EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		$val = 0;
		foreach ($a as $row => $item) {
			$val = (int)$val + 1;
			$bloque4 = <<<EOF

			<table border="1" style="font-size:9px; padding:1,7px 5px; border-collapse: collapse; border-radius:10px;">
				<tr>
					<td colspan="1">$val</td>
					<td colspan="7">$item[cal_paterno] $item[cal_materno] $item[cal_nombre]</td>
					<td>$item[cal_ser]</td>
					<td>$item[cal_saber1]</td>
					<td>$item[cal_saber2]</td>
					<td>$item[cal_saber3]</td>
					<td>$item[cal_saberpromedio]</td>
					<td>$item[cal_hacer1]</td>
					<td>$item[cal_hacer2]</td>
					<td>$item[cal_hacer3]</td>
					<td>$item[cal_hacerpromedio]</td>
					<td>$item[cal_decidir]</td>
					<td style="background-color:#E2F4FB">$item[cal_evaluacion]</td>
					<td>$item[auto_ser]</td>
					<td>$item[auto_decidir]</td>
					<td style="background-color:#E2F4FB">$item[auto_suma]</td>
					<td style="background-color:#C5EAF8">$item[cal_notafinal]</td>
				</tr>
			</table>

EOF;
			//$bloque4 = utf8_encode($bloque4);
			$bloque4 = utf8_encode(utf8_decode($bloque4));
			$pdf->writeHTML($bloque4, false, false, false, false, '');
		}
		$pdf->Output('2b_len.pdf');
	}
}

$a = new ImprimirReporte();
//$a -> codigo = $_GET["codigo"];
$a->traerImpresionSolicitudCompra();
?>