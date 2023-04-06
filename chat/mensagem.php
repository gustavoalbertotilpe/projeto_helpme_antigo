<?php
    session_start();
    if(isset($_SESSION["NOME"])){
        $NOME = $_SESSION["NOME"];
        $ID = $_SESSION["ID"];
    }else{
        header("location:index.php");
        die();
    }
    echo"<h1>Bem-vindo, ".$NOME."</h1>";
    require("../pages/conn.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <title>Help-Me</title>
    <script src='../js/jquery-3.4.1.min.js'></script>
    <script>
        $(function(){
            document.addEventListener('keypress', function(e){
            if(e.which == 13){
                var valor = $("input[type=hidden][name=id]").serializeArray();
                var texto = $('#caixatexto').serializeArray();
                var dados = valor.concat(texto);
                if($('#caixatexto').val().length > 0){
                    $.ajax({
                        url: 'mensagens.php',
                        method: "POST",
                        data: dados,
                        success: function(data){
                        $('#caixatexto').val('');
                        $('.caixa-txt-chat').scrollTop($('.caixa-txt-chat')[0].scrollHeight);    
                        $('#teste').html(data);
                        }
                    }); 
                 
                        
                }
            }
         }, false);
         function atualizaMensagem(){
                $.ajax({
                    url:'mostrarmensagem.php',
                    success: function(data){
                        $('#head-chat').html(data);
                    }
                })
            }

            setInterval(function(){atualizaMensagem();},1000);
        });
    </script>

</head>
<body>
    <div id='teste'></div>
<div class='conteu-chat-principal'>
    <div id='nomeC' class="nome"></div>
    <div  id ='head-chat' class='head-chat'></div>
    <div class='caixa-txt-chat'>
        <form method="POST" id="formulario">
         <textarea id='caixatexto' class='caixa-txt' name='texto' placeholder="Digite aqui a sua mensagem..."></textarea>
         <input id='idu' type="hidden" name='id' value='<?php echo $ID;?>'>
        </form>
    </div>   
</div>