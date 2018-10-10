<?php
                                    function MostreSemanas(){ //Mostra as letras dos dias da semana
                                        $semanas = "DSTQQSS";
                                        for($i = 0; $i < 7; $i++)
                                            echo "<td style='text-align:center'>".$semanas{$i}."</td>";
                                    }

                                    function GetNumeroDias($mes){ //Pega o número de dias do mês
                                        $numero_dias = array( 
                                            '01' => 31, '02' => 28, '03' => 31, '04' =>30, '05' => 31, '06' => 30,
                                            '07' => 31, '08' =>31, '09' => 30, '10' => 31, '11' => 30, '12' => 31
                                        );

                                        if (((date('Y') % 4) == 0 and (date('Y') % 100)!=0) or (date('Y') % 400)==0){
                                            $numero_dias['02'] = 29;    //Altera o numero de dias de fevereiro se o ano for bissexto
                                        }
                                        
                                        return $numero_dias[$mes];
                                    }

                                    function GetNomeMes($mes){ //Pega o nome do mês
                                        $meses = array( '01' => "Janeiro", '02' => "Fevereiro", '03' => "Março",
                                                         '04' => "Abril",   '05' => "Maio",      '06' => "Junho",
                                                         '07' => "Julho",   '08' => "Agosto",    '09' => "Setembro",
                                                         '10' => "Outubro", '11' => "Novembro",  '12' => "Dezembro");

                                        if($mes >= 01 && $mes <= 12)
                                            return $meses[$mes];

                                            return "Mês deconhecido";
                                    }

                                    function MostreCalendario($mes){ //Exibe o calendário de um mês específico
                                        $conexao = mysqli_connect("Localhost", "root", "", "cal");
                                        mysqli_query($conexao, "SET NAMES 'utf8'");
                                        mysqli_query($conexao, 'SET character_set_connection=utf8');
                                        mysqli_query($conexao, 'SET character_set_client=utf8');
                                        mysqli_query($conexao, 'SET character_set_results=utf8');
                                        
                                        $numero_dias = GetNumeroDias($mes);	//Retorna o número de dias que tem o mês desejado
                                        $nome_mes = GetNomeMes($mes); //Retorna o nome do mês desejado

                                        $mes_anterior = $mes - 1;
                                        $proximo_mes = $mes + 1;
                                        if($mes == 01){
                                            $mes_anterior = $mes;
                                        }elseif($mes == 12){
                                            $proximo_mes = $mes;
                                        }
                                            
                                        $diacorrente = 0;	
                                        $diasemana = jddayofweek(cal_to_jd(CAL_GREGORIAN, $mes,"01",date('Y')), 0);	//Função que descobre o dia da semana

                                        echo "<table class='table table-bordered' align = 'center'>";
                                            echo "<tr>";
                                                echo "
                                                <td colspan = 7 style='text-align:center'>
                                                    <h3>
                                                        <a href='#' onclick='mostrarMes($mes_anterior)'><i style='float:left;' class='far fa-angle-left mt-1'></i></a>
                                                        ".$nome_mes."
                                                        <a href='#' onclick='mostrarMes($proximo_mes)'><i style='float:right;' class='far fa-angle-right mt-1'></i></a>
                                                    </h3> 
                                                </td>";
                                            echo "</tr>";
                                            echo "<tr>";
                                                MostreSemanas();	//Função que mostra as semanas aqui
                                            echo "</tr>";
                                        
                                            for($linha = 0; $linha < 6; $linha++){
                                                echo "<tr>";

                                                for( $coluna = 0; $coluna < 7; $coluna++){
                                                    echo "<td height='90' "; //Altura e largura da célula

                                                    if( ($diacorrente == (date('d') - 1) && date('m') == $mes)){    //Se for o dia atual
                                                        echo " id='dia_atual' style='background-color:#CCC;'>"; 
                                                    }else{  
                                                        if(($diacorrente + 1) <= $numero_dias){
                                                            if( $coluna < $diasemana && $linha == 0){
                                                                echo " id = 'dia_branco'>";
                                                            }else{
                                                                echo " id = 'dia_comum'>";
                                                            }
                                                        }else{
                                                            echo " >";
                                                        }
                                                    }//echo ">";

                                                    /* TRECHO IMPORTANTE: A PARTIR DESTE TRECHO É MOSTRADO UM DIA DO CALENDÁRIO (MUITA ATENÇÃO NA HORA DA MANUTENÇÃO) */

                                                    if( $diacorrente + 1 <= $numero_dias ){
                                                        if( $coluna < $diasemana && $linha == 0){
                                                            echo " ";
                                                        }else{
                                                            //echo "<input type = 'button' id = 'dia_comum' name = 'dia".($diacorrente+1)."'  value = '".++$diacorrente."' onclick = 'acao(this.value)'>";
                                                            echo "<a href = ".$_SERVER["PHP_SELF"]."?mes=$mes&dia=".($diacorrente+1).">".++$diacorrente."</a>";
                                                            echo "<br>";
                                                            $sql = "select * from evento where data_evento like '".date('Y')."-".$mes."-";
                                                            if(strlen(++$dia_corrente) == 1){
                                                                $sql .= "0".$dia_corrente."'";
                                                            }else{
                                                                $sql .= $dia_corrente."'";
                                                            }
                                                            //echo $sql;
                                                            $query = mysqli_query($conexao, $sql);
                                                            if(mysqli_num_rows($query) > 0){
                                                                while($array = mysqli_fetch_array($query)){
                                                                    //echo "<p>".$array['tipo']." de ".$array['id_disc']."</p>";
                                                                    echo "<a href='#' data-toggle='modal' data-target='#modal-event' data-event='".$array['id_evento']."'><p style='font-size:18px;'><span class='badge badge-info'>".$array['tipo']." de Inglês</span></p></a>";
                                                                    //echo "<p><span class='badge badge-info'>".$array['tipo']." de Inglês</span></p>";
                                                                    //echo'Trabalho de IS';
                                                                }
                                                            }
                                                        }
                                                    }else{
                                                        break;
                                                    }
                                                    
                                                    /* FIM DO TRECHO MUITO IMPORTANTE */

                                                    echo "</td>";
                                                }
                                                echo "</tr>";
                                            }
                                        echo "</table>";
                                    } //Fim da função de exibir o mês

                                    function MostreCalendarioCompleto(){ //Mostra o calendário de todos os meses
                                        echo "<table align = 'center'>";
                                        $cont = 1;
                                        for($j = 0; $j < 4; $j++){
                                            echo "<tr>";
                                                for($i = 0; $i < 3; $i++){
                                                    echo "<td>";
                                                        MostreCalendario(($cont < 10) ? "0".$cont : $cont);  
                                                        $cont++;
                                                    echo "</td>";
                                                }
                                            echo "</tr>";
                                        }
                                        echo "</table>";
                                    }