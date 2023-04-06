<?php
session_start();
require("../pages/conn.php");?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_POST["nome"]) && empty($_POST["nome"]==false)){
            $nome = $_POST["nome"];
            $login= $_POST['login'];
            $senha =$_POST['senha'];
            $sql = "INSERT INTO CHAT (NOME,EMAIL,SENHA) VALUES('$nome','$login','$senha')";
            mysqli_query($banco,$sql);
            echo"<script>alert('Cadastrado com sucesso!')</script>";
            header("location:index.php");
            die();
        }
    ?>
    <div>
        <form action='' method='POST'>
            <label>Nome: <input type='text' name='nome' size=40 required></label>
            <br/>
            <br/>
            <label>E-mail: <input type='text' name='login' size=40 required></label>
            <br/>
            <br/>
            <label>Senha: <input type='password' name='senha' size=40 required></label>
            <br/>
            <br/>
            <input type='submit'>
        </form>    
    <div>
</body>
</html>