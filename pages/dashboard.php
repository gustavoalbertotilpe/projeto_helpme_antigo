<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="../js/jquery-3.4.1.js"></script>
    <title>Help-Me</title>
    <script>
          $(function(){
            function tblChamados(){
                $.ajax({
                    url:'chamados.php',
                    success:function(data){
                        $('#tbl_chamados').html(data);
                    }
                });
            }
            setInterval(function(){tblChamados();},1000);
        });
    </script>
</head>
<body>
    <div>
        <div class='dashtop'>
            <a href="">Historico|</a>
            <a href="">Atulizar contato tecnico|</a>
            <a href="../chat/">chat</a>
        </div>
        <div class='dashcont'>
           <div id='tbl_chamados'>
           </div>
        </div>
    </div>
</body>
</html>