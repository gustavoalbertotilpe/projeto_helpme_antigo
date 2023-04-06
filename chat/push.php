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
}









      