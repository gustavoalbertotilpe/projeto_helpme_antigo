<?php
session_start();
if(isset($_SESSION["NOME"])){
    $NOME = $_SESSION["NOME"];
    $ID = $_SESSION["ID"];
}else{
    header("location:index.php");
    die();
}
require("../pages/conn.php");

        $sql="SELECT ID_HELP_USUARIO, NOME,EMAIL FROM CHAT WHERE ID_HELP_USUARIO <> $ID";
        $result = mysqli_query($banco,$sql);
        echo"<ul>";
        while($row =  mysqli_fetch_assoc($result)){
            $IDCONTATO = $row["ID_HELP_USUARIO"];
            $sql2 = "SELECT COUNT(LIDO) AS LIDO FROM CHAT_MENSAGEM WHERE (LIDO = 1)&&(REMETENTE ='$IDCONTATO' && DESTINATARIO = '$ID')";
            $result2 = mysqli_query($banco,$sql2);
            while($row2 = mysqli_fetch_assoc($result2)){
            if($row2["LIDO"]==0){
                $not = "";
                $cor = "";
            }else{
                $not =  " Não lida ".$row2["LIDO"];
                $cor = "red";
            }
            }
            $sqlpsuh ="SELECT NOME, MENSAGEM FROM CHAT_MENSAGEM LEFT JOIN CHAT  ON ID_HELP_USUARIO = REMETENTE WHERE (REMETENTE ='$IDCONTATO' && DESTINATARIO = '$ID' && PUSH = 1)";
            $resultpush = mysqli_query($banco,$sqlpsuh);
            while($rowpush = mysqli_fetch_assoc($resultpush)){
                $nome = $rowpush["NOME"];
                $msg =substr($rowpush["MENSAGEM"],0,40)."...";
                echo"<script>var notificacao = new Notification('".$nome."', {
                    icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
                    body: '".$msg."'
                })</script>";
                $upNot = "UPDATE CHAT_MENSAGEM SET PUSH = 0 WHERE (REMETENTE ='$IDCONTATO' && DESTINATARIO = '$ID')";
                mysqli_query($banco,$upNot);  
            }  
            echo "<label  for='".$row["ID_HELP_USUARIO"]."'><li style='background-color:".$cor."'> ";
            echo $row["NOME"];
            echo $not;
            echo"</li></label>";
        }
        echo"</ul>";
    ?>