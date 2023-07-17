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

        $numero_tramite = $filas['hoja_numero_tramite'];

        // Buscamos la posición del guión ("-")
        $posicion_guion = strpos($numero_tramite, '-');

        // Extraemos los caracteres hasta la posición del guión
        $caracteres_extraidos = substr($numero_tramite, 0, $posicion_guion);

        // Imprimimos o usamos la variable $caracteres_extraidos según tus necesidades
        if ($caracteres_extraidos == 'QJAIT') {
            $materia = 'A.I.T.';
            $hoja_proceso = 'Nº Exp.';
            $color = '';
        }elseif ($caracteres_extraidos == 'QJADM') {
            $materia = 'ADMINISTRATIVO';
            $hoja_proceso= 'CUD';
            $color = '';
        }elseif ($caracteres_extraidos == 'QJA') {
            $materia = 'ADUANA';
            $hoja_proceso = 'Nº TRAMITE';
            $color = '';
        }elseif ($caracteres_extraidos == 'QJC') {
            $materia = 'CIVIL';
            $hoja_proceso = 'NUREJ';
            $color = '';
        }elseif ($caracteres_extraidos == 'QJCT') {
            $materia = 'CONTENCIOSO TRIBUTARIO';
            $hoja_proceso = 'NUREJ';
            $color = '';
        }elseif ($caracteres_extraidos == 'QJF') {
            $materia = 'FAMILIA';
            $hoja_proceso = 'NUREJ';
            $color = '';
        }elseif ($caracteres_extraidos == 'QJP') {
            $materia = 'PENAL';
            $hoja_proceso = 'CUD';
            $color = '';
        }elseif ($caracteres_extraidos == 'QJPA') {
            $materia = 'PENAL ADUANERO';
            $hoja_proceso = 'CUD';
            $color = '';
        }


        //SI LA HOJA DE RUTA ES DEL AREA JURIDICA MOSTRAMOS DE COLOR NARANJA
        //if ($filas[8]=='JURIDICO') {
        $cabecera = '<table style="font-size:16px;">
            <tbody>
                <tr>
                    <td style="width:100%; text-align:center; color:#000; border-left-color:#000; border-right-color:#000; border-bottom-color:#000; border-top-color:#000;"><b><br>BITACORA MATERIA '.$materia.'<br></b></td>
                </tr>
                <tr>
                    <td style="color:#000000; width:70%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000;"><b>'.$hoja_proceso.': </b>'.$filas['hoja_id_proceso'].'</td>
                    <td style="color:#000000; width:30%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000;"><b>JUZGADO: </b>'.substr($filas['hoja_num_juzgado'], 0, strpos($filas['hoja_num_juzgado'], ' ')).'</td>
                </tr>
                <tr>
                    <td style="color:#000000; width:100%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000;"><b>PROCESO: </b>'.$filas['hoja_tipo_proceso'].'</td>
                </tr>
                <tr>
                    <td style="color:#000000; width:100%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000;"><b>DEMANDANTE: </b>'.$filas['hoja_demandante'].'</td>
                </tr>
                <tr>
                    <td style="color:#000000; width:100%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000;"><b>DEMANDADO: </b>'.$filas['hoja_demandado'].'</td>
                </tr>
                <tr>
                    <td style="color:#000000; width:100%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000;"><br><br><b>DILIGENCIAS</b></td>
                </tr>
                <tr>
                    <td style="color:#000000; width:12%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:13px;"><b>FECHA</b></td>
                    <td style="color:#000000; width:33%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:13px;"><b>PRESENTAR</b></td>
                    <td style="color:#000000; width:12%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:13px;"><b>FECHA</b></td>
                    <td style="color:#000000; width:33%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:13px;"><b>RESPUESTA</b></td>
                    <td style="color:#000000; width:10%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:13px; text-align:center;"><b>Op</b></td>
                </tr>';
            
    $diligencia = '';
    $sql1="SELECT det_inicio, det_observacion, det_fin, det_respuesta_encargado, det_estado, det_accion FROM `hoja_detalle` WHERE hoja_id = '".$filas['hoja_id']."' AND det_estado = 'FINALIZADO' AND det_accion != 'AUDIENCIA';";
    $resultado1 = mysqli_query($conexion,$sql1);
    while ($dils = mysqli_fetch_assoc($resultado1)) {
        $diligencia .= '
            <tr>
                <td style="color:#000000; width:12%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:8px;">'.$dils['det_inicio'].'</td>
                <td style="color:#000000; width:33%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:10px;">'.$dils['det_observacion'].'</td>
                <td style="color:#000000; width:12%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:8px;">'.$dils['det_fin'].'</td>
                <td style="color:#000000; width:33%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:10px;">'.$dils['det_respuesta_encargado'].'</td>
                <td style="color:#000000; width:10%; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; text-align:center;"></td>
            </tr>';
    }
            $audiencia = '
                <tr>
                    <td style="color:#000000; width:100%; text-align:left; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000;"><br><br><b>AUDIENCIAS</b></td>
                </tr>
                <tr>
                    <td style="color:#000000; width:15%; text-align:left; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:13px;"><b>FECHA</b></td>
                    <td style="color:#000000; width:10%; text-align:left; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:13px;"><b>HORA</b></td>
                    <td style="color:#000000; width:50%; text-align:left; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:13px;"><b>AUDIENCIA</b></td>
                    <td style="color:#000000; width:25%; text-align:left; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:13px;"><b>JUZGADO</b></td>
                </tr>';

    $audiencias = '';
    $sql2 = "SELECT det_audiencia, det_accion, det_juzgado, det_lugar_juzgado, det_observacion FROM hoja_detalle WHERE hoja_id = '".$filas['hoja_id']."' AND det_accion = 'AUDIENCIA';";
    $resultado2 = mysqli_query($conexion,$sql2);
    while ($audi = mysqli_fetch_assoc($resultado2)) {
        $audiencias .= '
            <tr>
                <td style="color:#000000; width:15%; text-align:left; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:10px;">'.date('d-m-Y', strtotime($audi['det_audiencia'])).'</td>
                <td style="color:#000000; width:10%; text-align:left; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:10px;">'.date('H:i', strtotime($audi['det_audiencia'])).'</td>
                <td style="color:#000000; width:50%; text-align:left; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:13px;">'.$audi['det_observacion'].'</td>
                <td style="color:#000000; width:25%; text-align:left; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000; font-size:10px; text-align:center;">'.$audi['det_juzgado'].'<br>'.$audi['det_lugar_juzgado'].'</td>
            </tr>';
    }
            $observacion = '
                <tr>
                    <td style="color:#000000; width:100%; text-align:left; border-left-color:#000000; border-right-color:#000000; border-bottom-color:#000000; border-top-color:#000000;"><b><br>OBSERVACIONES:</b>________________________________________________________________________________________________________________________________________________<br></td>
                </tr>
            </tbody>
            </table>';

            $html = $cabecera.$diligencia.$audiencia.$audiencias.$observacion;
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