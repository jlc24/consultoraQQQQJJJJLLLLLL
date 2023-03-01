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
    public function traerImpresionSolicitudCompra()
    {
        error_reporting(0);
        setlocale(LC_TIME, "spanish");
        setlocale(LC_ALL,"es_ES");

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

        //SI LA HOJA DE RUTA ES DEL AREA JURIDICA MOSTRAMOS DE COLOR NARANJA
        if ($filas[8]=='JURIDICO') {
            $html = '<table style="font-size:16px;">
            <tbody>
                <tr>
                    <td style="width:100%; text-align:center; color:#8B4000; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b><br>CONSULTORA MULTIDISCIPLINARIA<br>"QUAESTIO JURIS LIMITADA"<br></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>HOJA DE RUTA Nº: </b>'.$filas[5].'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>FECHA DE INGRESO: </b>'.$filas[6].'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>FECHA DE SALIDA: </b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>NOMBRE SOLICITANTE: </b>'.$filas[2].'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>CELULAR SOLICITANTE: </b>'.$filas[4].'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>RESPONSABLE: </b>'.$filas[9].'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:33%; text-align:center; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>JURÍDICA</b></td>
                    <td style="color:#8B4000; width:34%; text-align:center; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>CONTABLE</b></td>
                    <td style="color:#8B4000; width:33%; text-align:center; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>MARKETING</b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:23%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>CIVIL</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b></b></td>
                    <td style="color:#8B4000; width:24%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>COMERCIAL</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b></b></td>
                    <td style="color:#8B4000; width:23%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>TIENDA</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:23%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>FAMILIAR</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b></b></td>
                    <td style="color:#8B4000; width:24%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>CONTA.</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b></b></td>
                    <td style="color:#8B4000; width:23%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>FACEBOOK</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:23%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>ADUANERA</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b></b></td>
                    <td style="color:#8B4000; width:24%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>AUDITORIA</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b></b></td>
                    <td style="color:#8B4000; width:23%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b>WHATSAPP</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:50%; text-align:center; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b><br><br><br><br><br><br>Firma y Sello </b></td>
                    <td style="color:#8B4000; width:50%; border-left-color:orange; border-right-color:orange; border-bottom-color:orange; border-top-color:orange;"><b></b></td>
                </tr>
            </tbody>
            </table>';
            // output the HTML content
            $pdf->writeHTML($html, true, false, true, false, '');
        }
        //SI LA HOJA DE RUTA ES DEL AREA CONTABLE MOSTRAMOS DE COLOR VERDE
        if ($filas[8]=='CONTABLE') {
            $html = '<table style="font-size:16px;">
            <tbody>
                <tr>
                    <td style="width:100%; text-align:center; color:#8B4000; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b><br>CONSULTORA MULTIDISCIPLINARIA<br>"QUAESTIO JURIS LIMITADA"<br></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:50%; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>Hoja de trámite Nº: </b>'.$filas[5].'</td>
                    <td style="color:#8B4000; width:50%; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>Nota N&ordm;: </b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:50%; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>Fecha de ingreso: </b>'.$filas[6].'</td>
                    <td style="color:#8B4000; width:50%; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>Fecha de salida   : </b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:50%; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>Solicitante: </b>'.$filas[2].'</td>
                    <td style="color:#8B4000; width:50%; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>Celular: </b>'.$filas[4].'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:100%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>Responsable: </b>'.$filas[9].'</td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:33%; text-align:center; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>JURÍDICA</b></td>
                    <td style="color:#8B4000; width:34%; text-align:center; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>CONTABLE</b></td>
                    <td style="color:#8B4000; width:33%; text-align:center; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>MARKETING</b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:23%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>CIVIL</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b></b></td>
                    <td style="color:#8B4000; width:24%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>COMERCIAL</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b></b></td>
                    <td style="color:#8B4000; width:23%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>TIENDA</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:23%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>FAMILIAR</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b></b></td>
                    <td style="color:#8B4000; width:24%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>CONTA.</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b></b></td>
                    <td style="color:#8B4000; width:23%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>FACEBOOK</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:23%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>ADUANERA</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b></b></td>
                    <td style="color:#8B4000; width:24%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>AUDITORIA</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b></b></td>
                    <td style="color:#8B4000; width:23%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b>WHATSAPP</b></td>
                    <td style="color:#8B4000; width:10%; text-align:left; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b></b></td>
                </tr>
                <tr>
                    <td style="color:#8B4000; width:50%; text-align:center; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b><br><br><br>Firma y Sello </b></td>
                    <td style="color:#8B4000; width:50%; border-left-color:green; border-right-color:green; border-bottom-color:green; border-top-color:green;"><b></b></td>
                </tr>
            </tbody>
            </table>';
            // output the HTML content
            $pdf->writeHTML($html, true, false, true, false, '');
        }

        $pdf->Output('Hoja_Ruta_'.$filas[5].'.pdf');
    }
}

$a = new ImprimirReporte();
$a->traerImpresionSolicitudCompra();
?>