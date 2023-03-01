<?php
date_default_timezone_set('America/La_Paz');

class Conexion
{
    static public function Conectar()
    {
        $link = new PDO("mysql:host=localhost; dbname=farmacia", "root", "usbw");
        return $link;
    }
}

class ImprimirReporte
{
    public $codigo;
    public function Consulta()
    {
        $stmt = Conexion::Conectar()->prepare("SELECT *from detalle_factura WHERE fac_id = (SELECT numero_detalle FROM configuracion)");
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
        setlocale(LC_ALL,"es_ES");

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

        $pageLayout = array(80, 100); //  or array($height, $width) 

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $pageLayout, true, 'UTF-8', false);
        #Establecemos los márgenes izquierda, arriba y derecha:
        $pdf->SetMargins(7, 5, 7, true);
        #Establecemos el margen inferior:
        $pdf->SetAutoPageBreak(TRUE, 5);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->startPageGroup();
        $pdf->SetFont('courier', '', 8, '', true);
        $pdf->AddPage();
// ---------------------------------------------------------

//RECUPERAMOS E IMPRIMIMOS DATOS DE LA FACTURA
include('../../assets/inc/conexion.php');
$sql="SELECT * FROM factura WHERE fac_id = (SELECT numero_detalle FROM configuracion)";
$resultado = mysqli_query($conexion,$sql);
$filas = mysqli_fetch_array($resultado);

//OBTENEMOS LAS INICIALES DE QUIEN LE ATENDIO
$string = $filas[4];
$expr = '/(?<=\s|^)[a-z]/i';
preg_match_all($expr, $string, $matches);
$result = implode('', $matches[0]);
$result = strtoupper($result);



$html = '<div style="text-align: center; font-size:9px; font-weight: bold;">
FARMACIA VIRGEN DEL ROSARIO<br>
COMPROBANTE DE CAJA<br>
Caracollo - Bolivia</div>
--------------------------------------<br>
<table border="0" style="font-size:8px;">
<tbody>
    <tr>
        <td style="width:100%;"><b>Cliente: </b>'.$filas[2].'</td>
    </tr>
    <tr>
        <td style="width:50%;"><b>Fecha: </b>'.date_format(date_create($filas[8]), 'd/m/Y').'</td>
        <td style="width:50%;"><b>Nota N&ordm;: </b>'.$filas[0].'</td>
    </tr>
    <tr>
        <td style="width:50%;"><b>Hora: </b>'.date_format(date_create($filas[8]), 'H:i:s').'</td>
        <td style="width:50%;"><b>Le Atendió: </b>'.$result.'</td>
    </tr>
</tbody>
</table>--------------------------------------';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// INSETA UNA LINEA HORIZONTAL
//$pdf->writeHTML("<hr>", true, false, false, false, '');

// ---------------------------------------------------------
$tbl = <<<EOD
<table border="0" style="font-size:7px; padding:1px 1px; border-collapse: collapse; border-radius:10px" >
    <tr>
        <th style="width:15%; font-weight: bold; text-align:rigth;">Cant.</th>
        <th style="width:50%; font-weight: bold; text-align:center;">Detalle</th>
        <th style="width:15%; font-weight: bold; text-align:rigth;">P/U</th>
        <th style="width:20%; font-weight: bold; text-align:rigth;">SubTotal</th>
    </tr>
EOD;

        $pdf->writeHTML($tbl, true, false, false, false, '');


        $val = 0;
        foreach ($a as $row => $item) {
            $val = (int)$val + 1;
            $bloque2 = <<<EOF

            <table border="0" style="font-size:7px; padding:1px 1px; border-collapse: collapse; border-radius:10px;">
                <tr>
                    <td style="width:15%; text-align:center;">$item[det_cantidad]</td>    
                    <td style="width:50%;">$item[det_producto]</td>
                    <td style="width:15%; text-align:rigth;">$item[det_precio_unitario]</td>
                    <td style="width:20%; text-align:rigth;">$item[det_subtotal]</td>
                </tr>
            </table>

EOF;
            //$bloque2 = utf8_encode($bloque2);
            $bloque2 = utf8_encode(utf8_decode($bloque2));
            $pdf->writeHTML($bloque2, false, false, false, false, '');
        }

        // INSERTA UNA LINEA HORIZONTAL
        $pdf->writeHTML("<hr>", true, false, false, false, '');
        $tbl2 = <<<EOD
        <table border="0" style="font-size:7px; padding:1px 1px; border-collapse: collapse; border-radius:10px" >
            <tr>
                <th style="width:70%; font-weight: bold; text-align:left;" colspan="3">Total a Pagar: </th>
                <th style="width:30%; font-weight: bold; text-align:rigth;">Bs. $filas[5]</th>
            </tr>
EOD;
        $pdf->writeHTML($tbl2, true, false, false, false, '');

        $eslogan = '<p style="text-align: center; font-size:8px; font-weight: bold;">Compra Más, Paga Menos</p>';
        // output the HTML content
        $pdf->writeHTML($eslogan, true, false, true, false, '');

        $pdf->Output('Nota_'.$filas[0].'.pdf');
    }
}

$a = new ImprimirReporte();
//$a -> codigo = $_GET["codigo"];
$a->traerImpresionSolicitudCompra();
?>