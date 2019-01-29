<?php
require_once("../../../model/conexion.php");

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
		// escaping, additionally removing everything that could be (html/javascript-) code
	$q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$aColumns = array('codigo', 'nombre', 'descripcion');//Columnas de busqueda
	$sTable = "producto";
	$sWhere = "";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}

	var_dump($sWhere);
	include("../config/pagination.php"); //include pagination file
		//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
	$per_page = 5; //how much records you want to show
	$adjacents = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
	$count_query = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
	$row = mysqli_fetch_array($count_query);
	$numrows = $row['numrows'];
	$total_pages = ceil($numrows / $per_page);
	$reload = './index.php';
		//main query to fetch the data
	$sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
	$query = mysqli_query($con, $sql);
		//loop through fetched data
	if ($numrows > 0) {

		?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="warning">
					<th>Código</th>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th><span class="pull-right">Precio</span></th>
					<th><span class="pull-right">Cant.</span></th>
					<th class='text-center' style="width: 36px;">Agregar</th>
				</tr>
				<?php
			while ($row = mysqli_fetch_array($query)) {
				$idproducto = $row['idProducto'];
				$codigo = $row['codigo'];
				$nombre = $row['nombre'];
				$descripcion = $row['descripcion'];
				$precio_compra = "";
				?>
					<tr>
						<td><?php echo $codigo; ?></td>
						<td><?php echo $nombre; ?></td>
						<td><?php echo $descripcion; ?></td>
						<td class='col-xs-1'>
						<div class="pull-right">
						<input type="text" class="form-control" style="text-align:right" id="cantidad_<?php echo $idproducto; ?>"  value="1" >
						</div></td>
						<td class='col-xs-2'><div class="pull-right">
						<input type="text" class="form-control" style="text-align:right" id="precio_venta_<?php echo $idproducto; ?>"  value="<?php echo $precio_compra; ?>" >
						</div></td>
						<td class='text-center'><a class='btn btn-info'href="#" onclick="agregar('<?php echo $id_producto ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>
					</tr>
					<?php

			}
			?>
				<tr>
					<td colspan=5><span class="pull-right">
					<?php
				echo paginate($reload, $page, $total_pages, $adjacents);
				?></span></td>
				</tr>
			  </table>
			</div>
			<?php

	}
}
?>