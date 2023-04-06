<?php date_default_timezone_set('America/Sao_Paulo');
header('Content-Type: text/html; charset=utf-8');
require("conn.php");
?>

            <?php
                $sql = "SELECT * FROM HELP_CLIENTE  WHERE SITUACAO = 'ABERTO' ORDER BY ID_HELP_CLIENTE ASC";
                $result = mysqli_query($banco,$sql);
                $qtd= mysqli_num_rows($result);
                if($qtd > 0){
                echo"Chamados aberto: ".$qtd."<br><br>";
                echo"<div class='tbl_chamados'><table>";
                foreach($result as $row){
                    
                    echo"
                        <tr><td>".$row["SITUACAO"]."</td>
                            <td>".$row["NOME"]."</td>
                            <td>".$row["TELEFONE"]."</td>
                            <td>".$row["EMAIL"]."</td>
                            <td>".substr($row["SOLICITACAO"],0,30)."...</td>
                            <td>".$row["DATA_ABERTURA"]."</td>
                            <td><a href='detalhes.php?id=".$row["ID_HELP_CLIENTE"]."'>detalhes</a></td>
                        </tr>
                    ";
                } 
                echo"</table></div>";
                $sql2 ="SELECT * FROM HELP_CLIENTE  WHERE PUSH = 1";
                $result2 = mysqli_query($banco,$sql2);
                while($row2 = mysqli_fetch_assoc($result2)){
                       $nome = $row2["NOME"];
                       $msg =substr($row2["SOLICITACAO"],0,40)."...";
                        echo"<script>var notificacao = new Notification('NOVA SOLICITAÇÃO DE ".$nome."', {
                            icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
                            body: '".$msg."'
                        })</script>";
                        echo"OI";
                        $ID=$row["ID_HELP_CLIENTE"];
                        $upNot = "UPDATE HELP_CLIENTE SET PUSH = 0 WHERE ID_HELP_CLIENTE =  $ID ";
                        mysqli_query($banco,$upNot);  
                }        
                
                /*if($not ==1){
                    echo"<script>var notificacao = new Notification('Nome', {
                        icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
                        body: 'Notificacao 2'
                    })</script>";
                    $not =0;
                }*/
            }else{
                echo"<h1>Não tem chamado aberto no momento</h1>";
            }
                mysqli_close($banco);
            ?>