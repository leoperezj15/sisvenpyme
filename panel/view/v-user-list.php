<?php

if ( !isset($_SESSION["ACL"]) )
{
    header("location: index.php");
}

$pass = "**************";
$item = "";
foreach ($ListaDeUsuarios as $usuarios) 
{
	$item .="
		<tr>
			<th>". $usuarios->idUsuario->GetValue() ."</th>
			<th>". $usuarios->username->GetValue() ."</th>
			<th>". $pass ."</th>
			<th>". $usuarios->alias->GetValue() ."</th>
			<th>". $usuarios->idRol->GetValue() ."</th>
		</tr>
	"; 
}


$page = "

<div class='ctn-main'>
		<table>
			<thead>
				<tr>
					<th>idUsuario</th>
					<th>UserName</th>
					<th>Password</th>
					<th>Alias</th>
					<th>Rol</th>
				</tr>
			</thead>
			<tbody>
				$item
			</tbody>
		</table>

</div>

</body>
</html>
";



?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
	<meta name="author" content="Miguel Macias" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<title>ACL - List user</title>
    <link rel='stylesheet' type='text/css' href='view/css/main.css' />
    <script src="view/plugin/jquery-2.0.3.min.js"></script>
        
</head>

<body>

<div class="ctn-main">
    <div class="ctn-login" style="width: 480px; min-height:50px; height:auto;">
    	<center><h1>Lista de Usuarios</h1></center>
        <?php
            echo $page; ?>
    </div>
</div>

</body>
</html>