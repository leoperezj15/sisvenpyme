<?php

/**
 * @author		Leonardo Perez Justiniano
 * @company 	Blaufuß
 * @copyright 	2018
 */



?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>ACL - Login</title>
    <!-- <link rel='stylesheet' type='text/css' href='view/css/main.css' /> -->
    <!-- <link rel='stylesheet' type='text/css' href='view/css/floating-labels.css' /> -->
    
    <link rel="icon" href="view/icon/favicon.ico">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/signin.css">
    <script src="view/plugin/jquery-2.0.3.min.js"></script>
    
    <script>
        $(document).ready(function()
        {
            $("#btnSend").click(function()
            {
                
                user = $("#user").val();
                pass = $("#password").val();
                
                $.ajax({
            		type: "POST",
            		url: "control/x-fn.php",
            		data: "fn=Login&user=" + user  + "&pass=" + pass,
            		cache: false,
            		success: function (res){
                        
                        data = res.split("|");
                        
            			if (data[0] == "ok")
            			{          
                            //alert(data[1]);
                            setTimeout("reloadPage()", 1000);
            			}else{
                            alert(data[1]);
                            $("#user").focus();
            			}
            			
            		}
            	});
            })
        })
        function reloadPage()
        {
            location.reload();
        }
    </script>
</head>

<body class="text-center">
<!--Login antiguo-->
<form class="form-signin"><!--ctn-main-->
        <!-- <img class="mb-4" src="view/img/bootstrap-solid.svg" alt="" width="72" height="72"> -->
        <img class="mb-4" src="view/svg/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Sistema de Gestion para Compra y Venta en Pymes</h1>
    <!-- <div class="ctn-login">ctn-login -->
        <label for="user" class="sr-only">Ingrese su Usuario</label>
        <input type="text" id="user" class="form-control" placeholder="Ingrese su usuario" required autofocus>
        <label for="password" class="sr-only">Ingrese su password</label>
        <input type="password" id="password" class="form-control" placeholder="Ingrese su password" required>
        <input type="button" class="btn btn-lg btn-primary btn-block" id="btnSend" value="Ingresar" />
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>
<!--login-->
<!-- <div class="form-signin">
    <div class="text-center mb-4">
        <img class="mb-4" src="view/img/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Sistema de Gestion de Ventas Pyme</h1>
    </div>
    <div class="form-label-group">
        <input type="text" id="user" class="form-control" placeholder="ingrese su usuario" required autofocus>
        <label for="user">ingrese su usuario</label> -->
    <!-- </div>
    <div class="form-label-group">
        <input type="password" id="pass" class="form-control" placeholder="Ingrese su contraseña" required autofocus>
        <label for="pass">Ingrese su contraseña</label> -->
    <!-- </div>
    <div class="checkbox mb-3">
        <input type="checkbox" value="remember-me"> Recordar
    </div>

    <input class="btn btn-lg btn-primary btn-block" type="button" id="btnSend" value="Ingresar">
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
</div> -->

</body>
</html>