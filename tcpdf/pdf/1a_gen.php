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

class ImprimirReporte{

public $codigo; 
public function Consulta()
        {
            $stmt = Conexion::Conectar()->prepare("SELECT
			lenguaje1.est_id,
			lenguaje1.cal_paterno,
			lenguaje1.cal_materno,
			lenguaje1.cal_nombre,
			lenguaje1.cal_notafinal,
			sociales1.cal_notafinal,
			deportes1.cal_notafinal,
			musica1.cal_notafinal,
			artes1.cal_notafinal,
			matematica1.cal_notafinal,
			tecnica1.cal_notafinal,
			naturales1.cal_notafinal,
			religion1.cal_notafinal,
			lenguaje2.cal_notafinal,
			sociales2.cal_notafinal,
			deportes2.cal_notafinal,
			musica2.cal_notafinal,
			artes2.cal_notafinal,
			matematica2.cal_notafinal,
			tecnica2.cal_notafinal,
			naturales2.cal_notafinal,
			religion2.cal_notafinal,
			lenguaje3.cal_notafinal,
			sociales3.cal_notafinal,
			deportes3.cal_notafinal,
			musica3.cal_notafinal,
			artes3.cal_notafinal,
			matematica3.cal_notafinal,
			tecnica3.cal_notafinal,
			naturales3.cal_notafinal,
			religion3.cal_notafinal 
		FROM
			lenguaje1
			INNER JOIN sociales1 ON lenguaje1.est_id = sociales1.est_id
			INNER JOIN deportes1 ON sociales1.est_id = deportes1.est_id
			INNER JOIN musica1 ON deportes1.est_id = musica1.est_id
			INNER JOIN artes1 ON musica1.est_id = artes1.est_id
			INNER JOIN matematica1 ON artes1.est_id = matematica1.est_id
			INNER JOIN tecnica1 ON matematica1.est_id = tecnica1.est_id
			INNER JOIN naturales1 ON tecnica1.est_id = naturales1.est_id
			INNER JOIN religion1 ON naturales1.est_id = religion1.est_id
			INNER JOIN lenguaje2 ON naturales1.est_id = lenguaje2.est_id
			INNER JOIN sociales2 ON lenguaje2.est_id = sociales2.est_id
			INNER JOIN deportes2 ON sociales2.est_id = deportes2.est_id
			INNER JOIN musica2 ON deportes2.est_id = musica2.est_id
			INNER JOIN artes2 ON musica2.est_id = artes2.est_id
			INNER JOIN matematica2 ON artes2.est_id = matematica2.est_id
			INNER JOIN tecnica2 ON matematica2.est_id = tecnica2.est_id
			INNER JOIN naturales2 ON tecnica2.est_id = naturales2.est_id
			INNER JOIN religion2 ON naturales2.est_id = religion2.est_id
			INNER JOIN lenguaje3 ON naturales2.est_id = lenguaje3.est_id
			INNER JOIN sociales3 ON lenguaje3.est_id = sociales3.est_id
			INNER JOIN deportes3 ON sociales3.est_id = deportes3.est_id
			INNER JOIN musica3 ON deportes3.est_id = musica3.est_id
			INNER JOIN artes3 ON musica3.est_id = artes3.est_id
			INNER JOIN matematica3 ON artes3.est_id = matematica3.est_id
			INNER JOIN tecnica3 ON matematica3.est_id = tecnica3.est_id
			INNER JOIN naturales3 ON tecnica3.est_id = naturales3.est_id
			INNER JOIN religion3 ON naturales3.est_id = religion3.est_id 
		WHERE
			lenguaje1.cal_curso = '1A'");
            $stmt -> execute();
            return $stmt -> fetchAll();
            $stmt -> close();
            $stmt = null;
        }
public function traerImpresionSolicitudCompra(){
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
//$pageLayout = array(216, 330); //  or array($height, $width) 

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $pageLayout, true, 'UTF-8', false);
//$pdf->AddPage('L', 'LETTER');
$pdf->setPageOrientation('L');
$pdf->SetMargins(PDF_MARGIN_LEFT-5, PDF_MARGIN_TOP-20, PDF_MARGIN_RIGHT-10);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM-20);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF
	<table cellspacing="0" width="100%">
		<thead>
			<tr>
				<th style="width: 25%; text-align: center; font-weight: bold; font-size:10px;">UNIDAD EDUCATIVA <br> "LA KANTUTA 2"</th>
				<th style="width: 55%; color: black; font-weight: bold; font-size:16px; text-align:center; line-height:18px;">CENTRALIZADOR GENERAL 2021</th>
				<th style="width=20%;" rowspan="3"  align="center" valign="middle">
					<img style="height:55px;" src="images/K2.png">
				</th>
			</tr>
			<tr>
				<th></th>
				<th style="font-size:12px; text-align:center;">EDUCACIÓN COMUNITARIA VOCACIONAL</th>

			</tr>
			<tr>
				<th style="font-size:10px; text-align: center;">AÑO : <strong>2021 </strong> CURSO : <strong>1ro "A"</strong></th>
				<th></th>
			</tr>
		</thead>
	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


$bloque3 = <<<EOF

	<table border="0.5" cellspacing="0" width="100%" style="font-size:6px; padding:1px 1px; border-collapse: collapse; border-radius:10px; text-align:center;">
		<thead>
			<tr>
				<th rowspan="2">Nº</th>
				<th rowspan="2" colspan="7">APELLIDO(S)  NOMBRE(S)</th>
				<th colspan="4">COMUNICACIÓN<br>Y LENGUAJE </th>
				<th colspan="4">CIENCIAS<br>SOCIALES </th>
				<th colspan="4">EDUCACIÓN<br>FÍSICA Y DEPORTES </th>
				<th colspan="4">EDUCACIÓN<br>MUSICAL </th>
				<th colspan="4">ARTES PLÁSTICAS<br>Y VISUALES </th>
				<th colspan="4">MATÉMATICA</th>
				<th colspan="4">TÉCNICA<br>Y TECNOLOGÍA </th>
				<th colspan="4">CIENCIAS<br>NATURALES </th>
				<th colspan="4">VALORES<br>ESPIRITUALIDAD<br>Y RELIGIONES</th>
			</tr>
			<tr>
				<th>T1</th>
				<th>T2</th>
				<th>T3</th>
				<th>P.</th>
				<th>T1</th>
				<th>T2</th>
				<th>T3</th>
				<th>P.</th>
				<th>T1</th>
				<th>T2</th>
				<th>T3</th>
				<th>P.</th>
				<th>T1</th>
				<th>T2</th>
				<th>T3</th>
				<th>P.</th>
				<th>T1</th>
				<th>T2</th>
				<th>T3</th>
				<th>P.</th>
				<th>T1</th>
				<th>T2</th>
				<th>T3</th>
				<th>P.</th>
				<th>T1</th>
				<th>T2</th>
				<th>T3</th>
				<th>P.</th>
				<th>T1</th>
				<th>T2</th>
				<th>T3</th>
				<th>P.</th>
				<th>T1</th>
				<th>T2</th>
				<th>T3</th>
				<th>P.</th>
			</tr>
		</thead>
	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

$val = 0;
foreach($a as $row => $item){


$val = (int)$val + 1;
$bloque4 = <<<EOF

<table border="0.5" cellspacing="0" width="100%" style="font-size:7px; padding:2px 1px; border-collapse: collapse; border-radius:10px;">
	<tr>		
		<td style="text-align:center;">$val</td>
		<td colspan="7">&nbsp; $item[1] $item[2] $item[3]</td>

		<td style="text-align:center;">$item[4]</td>
		<td style="text-align:center;">$item[13]</td>
		<td style="text-align:center;">$item[22]</td>
		<td style="text-align:center; background-color:#F5FFCF"></td>

		<td style="text-align:center;">$item[5]</td>
		<td style="text-align:center;">$item[14]</td>
		<td style="text-align:center;">$item[23]</td>
		<td style="text-align:center; background-color:#F5FFCF"></td>

		<td style="text-align:center;">$item[6]</td>
		<td style="text-align:center;">$item[15]</td>
		<td style="text-align:center;">$item[24]</td>
		<td style="text-align:center; background-color:#F5FFCF"></td>

		<td style="text-align:center;">$item[7]</td>
		<td style="text-align:center;">$item[16]</td>
		<td style="text-align:center;">$item[25]</td>
		<td style="text-align:center; background-color:#F5FFCF"></td>

		<td style="text-align:center;">$item[8]</td>
		<td style="text-align:center;">$item[17]</td>
		<td style="text-align:center;">$item[26]</td>
		<td style="text-align:center; background-color:#F5FFCF"></td>

		<td style="text-align:center;">$item[9]</td>
		<td style="text-align:center;">$item[18]</td>
		<td style="text-align:center;">$item[27]</td>
		<td style="text-align:center; background-color:#F5FFCF"></td>
	
		<td style="text-align:center;">$item[10]</td>
		<td style="text-align:center;">$item[19]</td>
		<td style="text-align:center;">$item[28]</td>
		<td style="text-align:center; background-color:#F5FFCF"></td>

		<td style="text-align:center;">$item[11]</td>
		<td style="text-align:center;">$item[20]</td>
		<td style="text-align:center;">$item[29]</td>
		<td style="text-align:center; background-color:#F5FFCF"></td>

		<td style="text-align:center;">$item[12]</td>
		<td style="text-align:center;">$item[21]</td>
		<td style="text-align:center;">$item[30]</td>
		<td style="text-align:center; background-color:#F5FFCF"></td>
	</tr>
</table>

EOF;
//$bloque4 = utf8_encode($bloque4);
$bloque4 = utf8_encode(utf8_decode($bloque4));
$pdf->writeHTML($bloque4, false, false, false, false, '');

}
$pdf->Output('centralizador1a.pdf');

}

}

$a = new ImprimirReporte();
//$a -> codigo = $_GET["codigo"];
$a -> traerImpresionSolicitudCompra();

?>