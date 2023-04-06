<?php
require("conn.php");
     if(isset($_POST["procedimento"])){
        $id = $_POST["id"]; 
        $procedimento = strip_tags($_POST["procedimento"]);
        $status = strip_tags($_POST["status"]);
        $sql ="UPDATE help_cliente SET OBS = '$procedimento', SITUACAO ='$status'WHERE  ID_HELP_CLIENTE = $id ";
        mysqli_query($banco,$sql);
        header("location:dashboard.php?id=".$id."");
     }  
   