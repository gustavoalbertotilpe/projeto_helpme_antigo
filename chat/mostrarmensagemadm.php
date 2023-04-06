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
if(isset($_POST["idC"]) && empty($_POST["idC"]==false)){
    $codU = $_POST["idC"];   
    $sql = "SELECT ID_CHAT_MENSAGEM,REMETENTE,DESTINATARIO,MENSAGEM, LIDO,PUSH, DATE_FORMAT(DATA_INCLUSAO,'%T') AS DATA_INCLUSAO FROM CHAT_MENSAGEM WHERE (REMETENTE = $ID && DESTINATARIO = $codU) || (REMETENTE = $codU && DESTINATARIO = $ID) ORDER BY ID_CHAT_MENSAGEM DESC LIMIT 300";
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
        echo"<div class='".$class."'>";
        echo $row["MENSAGEM"];
        echo"<span class='data-mensagem'>".$row["DATA_INCLUSAO"]."<br>".$lido."</span>";
        echo"</div>";
    }
    $not = "UPDATE CHAT_MENSAGEM SET LIDO = 0 WHERE REMETENTE ='$codU' && DESTINATARIO = '$ID'"; 
    mysqli_query($banco,$not);    
}else{
    echo"Bem Vindo";
}
