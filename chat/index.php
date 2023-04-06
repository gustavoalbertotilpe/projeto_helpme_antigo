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
        if(isset($_POST["login"]) && empty($_POST["senha"]==false)){
            $login= $_POST['login'];
            $senha =$_POST['senha'];
            $sql = "SELECT * FROM CHAT WHERE EMAIL = '$login' && senha ='$senha'";
            $result = mysqli_query($banco,$sql);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $_SESSION["NOME"] = $row["NOME"];
                $_SESSION["NIVELACESSO"] = $row["NIVEL_ACESSO"];
                $_SESSION["ID"] = $row["ID_HELP_USUARIO"];
                $acesso = $row["NIVEL_ACESSO"];
                if($acesso == 1){
                    header("location:adm.php");
                    mysqli_close($banco);
                    die();
                }else{
                    header("location:mensagem.php");
                    mysqli_close($banco);
                    die();
                }
            }else{
                echo"<script>alert('Usuario ou senha invalido');</script>";
            }
           
        }
    ?>
    <div>
        <form action='' method='POST'>
            <label>Login: <input type='text' name='login' size=40></label>
            <br/>
            <br/>
            <label>Senha: <input type='password' name='senha' size=40></label>
            <br/>
            <br/>
            <input type='submit'>
        </form>    
    <div>
    <div>
        <h2>Não tem usuario?</h2>
        <h3><a href='cadastro.php'>Cadastre-se</a></h3>
    </div>
</body>
</html>