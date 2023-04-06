<?php date_default_timezone_set('America/Sao_Paulo');
header('Content-Type: text/html; charset=utf-8');
require("pages/conn.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Help-Me</title>
    
</head>
<body>
    <div class="corpo">
        <div class="topo">
            <a href="chat/">Chat</a>
        </div>
        <div class="conteudo">
            <div class="conteudo-left">
                <a href="arquivos/tv.exe">Download do TeanViewer</a>
            </div>
            <?php
                if(isset($_POST["nome"]) && empty($_POST["nome"] == false)){
                    $nome = strip_tags($_POST["nome"]);
                    $tel = strip_tags($_POST["telefone"]);
                    $txt = strip_tags($_POST["solicitacao"]); 
                    $email = strip_tags($_POST["email"]);
                    $cod = "help";
                    $hora = date("HidY");
                    $numero = rand(0,988);          
                    $cod.=$numero;
                    $cod.=$hora;
                    $sql = "INSERT INTO help_cliente (NOME,TELEFONE,EMAIL,SOLICITACAO,COD) VALUES ('$nome','$tel','$email','$txt','$cod')";
                    if(mysqli_query($banco,$sql)){
                        echo"<script>alert('Sua solicitação ".$cod." foi aberta com sucesso, em breve o tecnico entrara em contato para solucionar o seu problema')</script>";
                    }    
                } 
            ?>
            <div class="conteudo-formulario">
                <form action="" method="POST">
                    <label>Nome<label>
                    <br/>
                    <br/>
                    <input type="text" name="nome" autocomplete="off">
                    <br/>
                    <br/>
                    <label>Telefone</label>
                    <br/>
                    <br/>
                    <input type='text' name='telefone' autocomplete="off">
                    <br/>
                    <br/>
                    <label>E-mail</label>
                    <br/>
                    <br/>
                    <input type="text" name="email" autocomplete="off">
                    <br/>
                    <br/>
                    <label>Solicitação</label>
                    <br/>
                    <br/>
                    <textarea name="solicitacao"></textarea>
                    <br/>
                    <br/>
                    <input type="submit" value="Enviar">
                </form>
            </div>
            <div class="conteudo-rigth">
                <div class="conteudo-rigth-contato">
                    <h3>Contato do Tecnico</h3>
                    <p>Nome: Fulano</p>
                    <p>Telefone: (42) 4444-4444</p>
                    <p>E-mail: fulano@email.com.br</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>