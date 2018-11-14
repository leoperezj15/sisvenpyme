<?php

/**
 * @author		Leonardo Perez Justiniano
 * @company 	Blaufuß
 * @copyright 	2018
 */



?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
	<meta name="author" content="Leonardo Perez Justiniano" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<title>ACL - Login</title>
    <link rel='stylesheet' type='text/css' href='view/css/main.css' />
    <!-- <link rel='stylesheet' type='text/css' href='view/css/floating-labels.css' /> -->
    <script src="view/plugin/jquery-2.0.3.min.js"></script>
    <link rel="icon" href="view/icon/favicon.ico">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
    
    <script>
        $(document).ready(function()
        {
            $("#btnSend").click(function()
            {
                
                user = $("#user").val();
                pass = $("#pass").val();
                
                $.ajax({
            		type: "POST",
            		url: "control/x-fn.php",
            		data: "fn=Login&user=" + user  + "&pass=" + pass,
            		cache: false,
            		success: function (res){
                        
                        data = res.split("|");
                        
            			if (data[0] == "ok")
            			{          
                            alert(data[1]);
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

<body>
<!--Login antiguo-->
<div class="form-signin"><!--ctn-main-->
    <div class="text-center mb-4">
        <!-- <img class="mb-4" src="view/img/bootstrap-solid.svg" alt="" width="72" height="72"> -->
        <h1 class="h3 mb-3 font-weight-normal">Sistema de Gestion de Ventas Pyme</h1>
    </div>
    <div class="ctn-login"><!--ctn-login-->
        <input type="text" id="user" placeholder="Ingrese su usuario" />
        <input type="password" id="pass" placeholder="Ingrese su contraseña" />
        <input type="button" id="btnSend" value="Ingresar" />
    </div>
</div>
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