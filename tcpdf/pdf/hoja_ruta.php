<?php
date_default_timezone_set('America/La_Paz');

class Conexion
{
    static public function Conectar()
    {
        $link = new PDO("mysql:host=localhost; dbname=consultora", "root", "");
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
                $pdf->SetMargins(25, 65, 25, true); //las medidas estan en milimetros
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
        $sql="SELECT * FROM vista_hoja WHERE hoja_id = (SELECT hoja_id FROM configuracion)";
        $resultado = mysqli_query($conexion,$sql);
        $filas = mysqli_fetch_assoc($resultado);

        if ($filas['hoja_patrocinio'] == 'VICTIMA' || $filas['hoja_patrocinio'] == 'DEMANDANTE') {
            $cliente = $filas['hoja_demandante'];
        }else {
            $cliente = $filas['hoja_demandado'];
        }


        //SI LA HOJA DE RUTA ES DEL AREA JURIDICA MOSTRAMOS DE COLOR NARANJA
        //if ($filas[8]=='JURIDICO') {
            $html = '<table style="font-size:16px;">
            <tbody>
                <tr>
                    <td style="width:100%; text-align:center; color:#8B4000; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b><br>CONSULTORA MULTIDISCIPLINARIA<br>"QUAESTIO JURIS LIMITADA"<br></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>HOJA DE RUTA Nº: </b>'.$filas['hoja_numero_tramite'].'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>FECHA DE INGRESO: </b>'.$filas['hoja_fecha_ingreso'].'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>FECHA DE SALIDA: </b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>NOMBRE SOLICITANTE: </b>'.$cliente.'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>C.I. SOLICITANTE: </b>'.$filas['ci_cliente'].'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>CELULAR SOLICITANTE: </b>'.$filas['celular_cliente'].'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>REFERENCIA:</b>'.$filas['hoja_tipo_proceso'].'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>RESPONSABLE:</b>DR. JORGE L. HERBAS HUAYLLAS</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:33%; text-align:center; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>JURÍDICA</b></td>
                    <td style="color:#8B4000; width:34%; text-align:center; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>CONTABLE</b></td>
                    <td style="color:#8B4000; width:33%; text-align:center; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>MARKETING</b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:28%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>CIVIL</b></td>
                    <td style="color:#8B4000; width:5%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b></b></td>
                    <td style="color:#8B4000; width:29%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>COMERCIAL</b></td>
                    <td style="color:#8B4000; width:5%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b></b></td>
                    <td style="color:#8B4000; width:28%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>D. GRAFICO</b></td>
                    <td style="color:#8B4000; width:5%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:28%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>FAMILIAR</b></td>
                    <td style="color:#8B4000; width:5%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b></b></td>
                    <td style="color:#8B4000; width:29%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>CONTABLE</b></td>
                    <td style="color:#8B4000; width:5%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b></b></td>
                    <td style="color:#8B4000; width:28%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>FACEBOOK</b></td>
                    <td style="color:#8B4000; width:5%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:28%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>PENAL</b></td>
                    <td style="color:#8B4000; width:5%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b></b></td>
                    <td style="color:#8B4000; width:29%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>ADM.</b></td>
                    <td style="color:#8B4000; width:5%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b></b></td>
                    <td style="color:#8B4000; width:28%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>TIKTOK</b></td>
                    <td style="color:#8B4000; width:5%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:28%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>ADUANERA</b></td>
                    <td style="color:#8B4000; width:5%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b></b></td>
                    <td style="color:#8B4000; width:29%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>AUDITORIA</b></td>
                    <td style="color:#8B4000; width:5%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b></b></td>
                    <td style="color:#8B4000; width:28%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>WHATSAPP</b></td>
                    <td style="color:#8B4000; width:5%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; text-align:left; border-left-color:#8B4000; border-right-color:#8B4000; border-bottom-color:#8B4000; border-top-color:#8B4000;"><b>INSTRUCCIONES:</b>________________________________________________________________________________________________________________________________________________________________________________________________<br></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; text-align:center;"><b><br><br><br><br><br>Firma y Sello </b></td>
                </tr>
            </tbody>
            </table>';
            // output the HTML content
            $pdf->writeHTML($html, true, false, true, false, '');
        //}
        //SI LA HOJA DE RUTA ES DEL AREA CONTABLE MOSTRAMOS DE COLOR VERDE

        // output the HTML content
        //$pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Hoja_Ruta_'.$filas[5].'.pdf');
    }
}

$a = new ImprimirReporte();
//$a -> codigo = $_GET["codigo"];
$a->traerImpresionSolicitudCompra();
?>