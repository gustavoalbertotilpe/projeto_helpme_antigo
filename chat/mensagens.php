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
    $mensagem = $_POST["texto"];
    if(isset($_POST["idC"]) && empty($_POST["idC"]==false)){
        $idcontatos = $_POST["idC"];
    }else{
        $idcontatos = 1;
    }
    $sql = "INSERT INTO CHAT_MENSAGEM (REMETENTE,DESTINATARIO,MENSAGEM) VALUES($ID, $idcontatos,'$mensagem')";
    mysqli_query($banco,$sql);