<?php
/**
 * @author Leonardo Perez
 * @copyright ACL - PyME
 */

$ListaDeModulos = "<select name='modulo'>";
foreach ($listarModulos as $Modulos) 
{
	$NombreModulo = $Modulos->nombre->value;
	$ListaDeModulos .= "<option value='". $Modulos->idModulo->valor ."'>". $NombreModulo ."</option>";
}
$ListaDeModulos .= "</select>";



$page = "
<form method='post'>
<table align='center'>
<tr>
    <td>Nombre de Usuario</td>
    <td>:</td>
    <td><input type='text' name='user'></td>
</tr>
<tr>
    <td>Password</td>
    <td>:</td>
    <td><input type='password' name='pass'></td>
</tr>
<tr>
    <td>Alias</td>
    <td>:</td>
    <td><input type='text' name='user'></td>
</tr>
<tr>
    <td>Email</td>
    <td>:</td>
    <td><input type='text' name='user'></td>
</tr>
<tr>
    <td>Rol</td>
    <td>:</td>
    <td>$ListaDeModulos</td>
</tr>
<tr>
    <td colspan='3'>
        <input type='submit' value='Guardar'>
    </td>
</tr>
</table>
</form>

";
echo $page;

?>