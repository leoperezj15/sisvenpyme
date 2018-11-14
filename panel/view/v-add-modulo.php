<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="view/plugin/jquery-2.0.3.min.js"></script>
    <script src="view/plugin/modulo/insert.js"></script>
    <title>Document</title>
</head>
<body>
    <h1 class="">Registrar un Nuevo Modulo</h1>
    <div class="container">
        <div class="row">
            <form class="form-horizontal" role="form" method="POST" action="control/addModulo.php">
                <label for="modulo">Nombre Modulo</label>
                <input type="text" name="nombre" id="nombre" class="text">
                <input type="submit" class="btn btn-success" value="Guardar">
                <a href="?mnu=menu"><input type="button" value="Cancelar" class="btn btn-success"></a>
            </form>
        </div>
    </div>
    
</body>
</html>