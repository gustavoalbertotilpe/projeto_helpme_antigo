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
    
$sql = "SELECT ID_CHAT_MENSAGEM,REMETENTE,DESTINATARIO,MENSAGEM, LIDO,PUSH, DATE_FORMAT(DATA_INCLUSAO,'%T') AS DATA_INCLUSAO FROM CHAT_MENSAGEM WHERE (REMETENTE = $ID && DESTINATARIO = 1) || (REMETENTE = 1 && DESTINATARIO = $ID) ORDER BY ID_CHAT_MENSAGEM DESC LIMIT 300";

$result = mysqli_query($banco,$sql);

foreach($result as $row ){
    if($row["REMETENTE"] == $ID){
        $class = "remetente";
    }else{
        $class ="destinatario";
    }
    if($row["LIDO"] ==1){
        $lido = "";
    }else{
        $lido = "Visualizado";
    }
    if($class == "destinatario"){
        $lido=" ";
    }
    $sqlpsuh ="SELECT NOME, MENSAGEM FROM CHAT_MENSAGEM LEFT JOIN CHAT  ON ID_HELP_USUARIO = REMETENTE WHERE (REMETENTE =1 && DESTINATARIO = '$ID' && PUSH = 1)";
    $resultpush = mysqli_query($banco,$sqlpsuh);
    while($rowpush = mysqli_fetch_assoc($resultpush)){
        $nome = $rowpush["NOME"];
        $msg =substr($rowpush["MENSAGEM"],0,40)."...";
        echo"<script>var notificacao = new Notification('".$nome."', {
            icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
            body: '".$msg."'
        })</script>";
        $upNot = "UPDATE CHAT_MENSAGEM SET PUSH = 0 WHERE (REMETENTE =1 && DESTINATARIO = '$ID')";
        mysqli_query($banco,$upNot); 
    }  
    $not = "UPDATE CHAT_MENSAGEM SET LIDO = 0 WHERE REMETENTE =1 && DESTINATARIO = '$ID'"; 
    mysqli_query($banco,$not);    

    echo"<div class='".$class."'>";
    echo $row["MENSAGEM"];
    echo"<span class='data-mensagem'>".$row["DATA_INCLUSAO"]."<br>".$lido."</span>";
    echo"</div>";
}
    