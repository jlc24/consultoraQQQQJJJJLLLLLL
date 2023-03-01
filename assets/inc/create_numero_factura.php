                                                    <input type="number" class="form-control" readonly="" id="fac_id" name="fac_id" 
                                                    value="<?php include('conexion.php');
                                                    //OBTENEMOS EL ULTIMO NUMERO DE LAS FACTURAS EXISTENTES
                                                    $consulta = "SELECT MAX(fac_id) FROM factura";
                                                    $result = mysqli_query($conexion,$consulta);
                                                    $fila = mysqli_fetch_row($result);
                                                    $valor = (int)$fila[0];
                                                    //SI NO HAY FACTURAS, ENTONCES CREAMOS LA FACTURA Nº 1, CON ESTADO = 0.
                                                    if($valor == 0){
                                                        $numero = $valor + 1;
                                                        $total = 0.00;
                                                        $estado = 0;
                                                        $sql="INSERT INTO factura(fac_id, fac_total, fac_estado) VALUES ('$numero', '$total', '$estado')";
                                                        mysqli_query($conexion,$sql);
                                                    }
                                                    //SI AL MENOS HAY UNA FACTURA VERIFICAMOS SU ESTADO, PARA CREAR O NO UNA NUEVA FACTURA
                                                    else{
                                                        $consulta1="SELECT fac_estado FROM factura WHERE fac_id = $valor";
                                                        $resultado1 = mysqli_query($conexion,$consulta1);
                                                        $filas1 = mysqli_fetch_row($resultado1);
                                                        $estado = (int)$filas1[0];
                                                        //SI EL ESTADO DE LA FACTURA = 1 (VENTA FINALIZADA) HAY QUE CREAR UNA NUEVA FACTURA
                                                        if($estado==1 OR $estado==2){
                                                            $numero = $valor + 1;
                                                            $total = 0.00;
                                                            $estado = 0;
                                                            $sql="INSERT INTO factura(fac_id, fac_total, fac_estado) VALUES ('$numero', '$total', '$estado')";
                                                            mysqli_query($conexion,$sql);
                                                        }
                                                    }
                                                    $sql="SELECT MAX(fac_id) FROM factura";
                                                    $resultado = mysqli_query($conexion,$sql);
                                                    $filas = mysqli_fetch_row($resultado);
                                                    $numero = (int)$filas[0];
                                                    /*RELLENA CON CEROS A LA IZQUIERDA, EL NUMERO DE LA FACTURA
                                                    echo str_pad($numero, 6, '0', STR_PAD_LEFT);*/ echo $numero;?>">