<?php require("conn.php");?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <title>Help-Me</title>
</head>
<body>
<a href='dashboard.php'>VOLTAR</a>
<br>
<br>
<?php
    if(isset($_GET["id"])&&empty($_GET["id"]==false)){
        $id= $_GET["id"];
        $sql = "SELECT * FROM help_cliente WHERE ID_HELP_CLIENTE = $id";
        $result = mysqli_query($banco,$sql);
        $row = mysqli_fetch_assoc($result);
        echo"
            <div class='conteudo-formulario'>
            <form action='atualiza.php' method='POST'>
            <label>Nome<label>
            <br/>
            <br/>
            <input type='text' name='nome' autocomplete='off' disabled='true' value='".$row["NOME"]."'>
            <br/>
            <br/>
            <label>Telefone</label>
            <br/>
            <br/>
            <input type='text' name='telefone' autocomplete='off' disabled='true' value='".$row["TELEFONE"]."'>
            <br/>
            <br/>
            <label>E-mail</label>
            <br/>
            <br/>
            <input type='text' name='email' disabled='true' value='".$row["EMAIL"]."'>
            <br/>
            <br/>
            <label>Solicitação</label>
            <br/>
            <br/>
            <textarea name='solicitacao' disabled='true' value='".$row["SOLICITACAO"]."'>".$row["SOLICITACAO"]."</textarea>
            <br/>
            <br/>
            <label>Procedimento</label>
            <br/>
            <br/>
            <textarea name='procedimento' value='".$row["OBS"]."'>".$row["OBS"]."</textarea>
            <br/>
            <br/>
            <label>Status</label>
            <br/>
            <br/>
            <select name='status'>
                <option value='".$row["SITUACAO"]."'selected>".$row["SITUACAO"]."</option>
                <option value='ABERTO'>Aberto</option>
                <option value='FECHADO'>Fechado</option>
            </select>
            <input type='hidden' name='id' value='".$id."'>
            <br/>
            <input type='submit' value='Enviar'>
            <br/>
            <br/>
            <br/>
        </form></div>
            ";
    }else{
        header("location:dashboard.php");
    }
   
?>
</body>
</head>