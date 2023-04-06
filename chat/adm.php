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
                var valor = $("input[type=radio][name=idC]:checked").serializeArray();
                var texto = $('#caixatexto').serializeArray();
                var dados = valor.concat(texto);
                if($('#caixatexto').val().length > 0){
                    $.ajax({
                        url: 'mensagens.php',
                        method: "POST",
                        data: dados,
                        success: function(data){
                        $('#caixatexto').val('');
                        }
                    }); 
                 
                        
                }
            }
         }, false);
         function atualizaMensagem(){
            var valor = $("input[type=radio][name=idC]:checked").serializeArray();
            var id = $("input[type=radio][name=idC]:checked").val();
            var nome = "<h3>" + $("label[for="+id+"]").text() + "</h3>";
            $('#nomeC').html(nome);
                $.ajax({
                    url:'mostrarmensagemadm.php',
                    method:"POST",
                    data: valor,
                    success: function(data){
                        $('#head-chat').html(data);
                    }
                })
            }

            setInterval(function(){atualizaMensagem();},1000);
            
            function atualizaContato(){
                $.ajax({
                    url:'contatos.php',
                    success: function(data){
                        $('#contatos').html(data);
                    }
                })
            }

            setInterval(function(){atualizaContato();},1000);


        });
    </script>

</head>
<body>
<div  class="contatos">
    <div id='contatos'></div>
</div>
<div class='contatosEscondidos'>
    <?php
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
                }else{
                    $not = $row2["LIDO"]."Não lido";
                }
            }
            echo"<li>";
            echo "<label for='".$row["ID_HELP_USUARIO"]."'><input id='".$row["ID_HELP_USUARIO"]."' type='radio' value='".$row["ID_HELP_USUARIO"]."' name='idC'>";
            echo $not;
            echo"</li>";
        }
        echo"</ul>";
    ?>
</div>
<div class='conteu-chat-principal'>  
    <div id='nomeC' class="nome"></div>
    <div  id ='head-chat' class='head-chat'></div>
    <div class='caixa-txt-chat'>
    <textarea id='caixatexto' class='caixa-txt' name='texto' placeholder="Digite aqui a sua mensagem..."></textarea>
</div>  
</div>
</body>
</html>