<?php
date_default_timezone_set('America/La_Paz');

class Conexion
{
    static public function Conectar()
    {
        $link = new PDO("mysql:host=localhost; dbname=consultora", "root", "usbw");
        return $link;
    }
}

class ImprimirReporte
{
    public $codigo;
    public function Consulta()
    {
        $stmt = Conexion::Conectar()->prepare("SELECT *from clientes WHERE fac_id = (SELECT numero_detalle FROM configuracion)");
        $stmt->execute();
        return $stmt->fetchAll();
        //$stmt->close();
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
        //Estilos 
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

                $pageLayout = array(216, 330); //  or array($height, $width) 

                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $pageLayout, true, 'UTF-8', false);
                #Establecemos los márgenes izquierda, arriba y derecha:
                $pdf->SetMargins(25, 65, 25, true); //las medias estan en milimetros
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
        $sql="SELECT * FROM hoja WHERE hoja_id = (SELECT hoja_id FROM configuracion)";
        $resultado = mysqli_query($conexion,$sql);
        $filas = mysqli_fetch_array($resultado);

        //OBTENEMOS LAS INICIALES DE QUIEN LE ATENDIO
        $string = $filas[4];
        $expr = '/(?<=\s|^)[a-z]/i';
        preg_match_all($expr, $string, $matches);
        $result = implode('', $matches[0]);
        $result = strtoupper($result);

        $html = '<table border="2" style="font-size:16px;">
        <tbody>
            <tr>
                <td style="width:100%; text-align:center; color:#8B4000;"><b><br>CONSULTORA MULTIDISCIPLINARIA<br>"QUAESTIO JURIS LIMITADA"<br></b></td>
            </tr>
            <tr>
                <td style="color:#8B4000; width:50%;"><b>Hoja de trámite Nº: </b>'.$filas[5].'</td>
                <td style="color:#8B4000; width:50%;"><b>Nota N&ordm;: </b></td>
            </tr>
            <tr>
                <td style="color:#8B4000; width:50%;"><b>Fecha de ingreso: </b>'.$filas[6].'</td>
                <td style="color:#8B4000; width:50%;"><b>Fecha de salida   : </b></td>
            </tr>
            <tr>
                <td style="color:#8B4000; width:50%;"><b>Solicitante: </b>'.$filas[2].'</td>
                <td style="color:#8B4000; width:50%;"><b>Celular: </b>'.$filas[4].'</td>
            </tr>
            <tr>
                <td style="color:#8B4000; width:100%; text-align:left;"><b>Responsable: </b>'.$filas[9].'</td>
            </tr>
            <tr>
                <td style="color:#8B4000; width:33%; text-align:center;"><b>JURÍDICA</b></td>
                <td style="color:#8B4000; width:34%; text-align:center;"><b>CONTABLE</b></td>
                <td style="color:#8B4000; width:33%; text-align:center;"><b>MARKETING</b></td>
            </tr>
            <tr>
                <td style="color:#8B4000; width:23%; text-align:left;"><b>CIVIL</b></td>
                <td style="color:#8B4000; width:10%; text-align:left;"><b></b></td>
                <td style="color:#8B4000; width:24%; text-align:left;"><b>COMERCIAL</b></td>
                <td style="color:#8B4000; width:10%; text-align:left;"><b></b></td>
                <td style="color:#8B4000; width:23%; text-align:left;"><b>TIENDA</b></td>
                <td style="color:#8B4000; width:10%; text-align:left;"><b></b></td>
            </tr>
            <tr>
                <td style="color:#8B4000; width:23%; text-align:left;"><b>FAMILIAR</b></td>
                <td style="color:#8B4000; width:10%; text-align:left;"><b></b></td>
                <td style="color:#8B4000; width:24%; text-align:left;"><b>CONTA.</b></td>
                <td style="color:#8B4000; width:10%; text-align:left;"><b></b></td>
                <td style="color:#8B4000; width:23%; text-align:left;"><b>FACEBOOK</b></td>
                <td style="color:#8B4000; width:10%; text-align:left;"><b></b></td>
            </tr>
            <tr>
                <td style="color:#8B4000; width:23%; text-align:left;"><b>ADUANERA</b></td>
                <td style="color:#8B4000; width:10%; text-align:left;"><b></b></td>
                <td style="color:#8B4000; width:24%; text-align:left;"><b>AUDITORIA</b></td>
                <td style="color:#8B4000; width:10%; text-align:left;"><b></b></td>
                <td style="color:#8B4000; width:23%; text-align:left;"><b>WHATSAPP</b></td>
                <td style="color:#8B4000; width:10%; text-align:left;"><b></b></td>
            </tr>
            <tr>
                <td style="color:#8B4000; width:50%; text-align:center;"><b><br><br><br>Firma y Sello </b></td>
                <td style="color:#8B4000; width:50%;"><b></b></td>
            </tr>
        </tbody>
        </table>';
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Hoja_Ruta_'.$filas[0].'.pdf');
    }
}

$a = new ImprimirReporte();
//$a -> codigo = $_GET["codigo"];
$a->traerImpresionSolicitudCompra();
?>