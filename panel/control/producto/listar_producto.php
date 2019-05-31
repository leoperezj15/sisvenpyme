<?php
	
	/* Connect To Database*/
require_once ("../../../model/conexion.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax')
{
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="`producto` t1";
    $campos="t1.*, 
    t2.idsubCategoria as t2_idsubCategoria, 
    t2.nombre as t2_nombre,
    t3.idCategoria as t3_idCategoria,
    t3.nombre as t3_nombre,
    t4.idunidadMedida as t4_idunidadMedida, 
    t4.nombre as t4_nombre,
    t4.abrev as t4_abrev";
    $inner="INNER JOIN `subcategoria` t2 on t1.idsubCategoria=t2.idsubCategoria
        INNER JOIN `categoria` t3 on t2.idCategoria=t3.idCategoria
        INNER JOIN `unidadmedida` t4 on t1.idunidadMedida=t4.idunidadMedida ";
	$sWhere=" t1.nombre LIKE '%".$query."%' ";
	$sWhere.=" order by idProducto ";
	
	//include_once "../config/pagination.php";
	//include "../config/pagination.php"; //include pagination file
	include("../config/pagination.php");
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($con);}
	$total_pages = ceil($numrows/$per_page);
	//main query to fetch the data
	$query = mysqli_query($con,"SELECT $campos FROM  $tables $inner where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data
	
	if ($numrows>0){	
	?>
		<div class="table-responsive table-sm">
			<table class="table table-sm table-striped">
				<thead class="table-dark">
					<tr>
						<th class='text-center'>Código</th>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th>Modelo</th>
						<th>Peso</th>
                        <th>Hecho en</th>
                        <th>Categoria</th>
                        <th>Sub Categoria</th>
                        <th>UM</th>
                        <th>Estado</td>
                        <th>OP</td>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
                            $idproducto=$row['idProducto'];
                            $hash=$row['hash'];
							$codigo=$row['codigo'];
							$nombre=$row['nombre'];
							$descripcion=$row['descripcion'];
                            $modelo=$row['modelo'];
                            $peso=$row['peso'];
                            $madein=$row['madein'];
                            $idsubcategoria=$row['t2_idsubCategoria'];
                            $subcategoria_nombre=$row['t2_nombre'];
                            $idcategoria=$row['t3_idCategoria'];
                            $categoria_nombre=$row['t3_nombre'];
                            $idunidadmedida=$row['t4_idunidadMedida'];
                            $unidadmedida_nombre=$row['t4_nombre'];
                            $unidadmedida_abrev=$row['t4_abrev'];
                            $estado =$row['estado'];			
							$finales++;
						?>	
						<tr class=" small"><!--<?php //echo $text_class;?>-->
							<td class='text-center'><strong><?php echo $codigo;?></strong></td>
							<td><strong><?php echo $nombre;?></strong></td>
							<td><?php echo $descripcion;?></td>
							<td><?php echo $modelo;?></td>
                            <td><?php echo $peso;?></td>
                            <td><?php echo $madein;?></td>
                            <td><?php echo $categoria_nombre;?></td>
                            <td><?php echo $subcategoria_nombre;?></td>
                            <td><?php echo $unidadmedida_abrev;?></td>
                            <td><span class="badge badge-success"><?php echo $estado;?></span></td>
							<td>
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<a href="#"  data-target="#editProductoModal" class="edit btn btn-warning" data-toggle="modal" 
										data-idproducto="<?php echo $idproducto;?>"  
										data-codigo="<?php echo $codigo?>" 
										data-nombre="<?php echo $nombre?>" 
										data-descripcion="<?php echo $descripcion?>" 
										data-modelo="<?php echo $modelo?>" 
										data-peso="<?php echo $peso?>"
										data-madein="<?php echo $madein?>"
										data-idcategoria="<?php echo $idcategoria?>"
										data-idsubcategoria="<?php echo $idsubcategoria?>"
										data-idunidadmedida="<?php echo $idunidadmedida?>"><i class="fas fa-edit"></i>
									</a>
									<a href="#deleteProductoModal" class="delete btn btn-danger" data-toggle="modal" 
									data-idproducto="<?php echo $idproducto;?>"><i class="fas fa-eraser"></i></a>
								</div>
                    		</td>
						</tr>
						<?php }?>
						<tr>
							<td colspan='11'>
								<nav aria-label="Page navigation example">

									<?php 
										$inicios=$offset+1;
										$finales+=$inicios -1;
										echo "Mostrando $inicios al $finales de $numrows registros";
										echo paginate( $page, $total_pages, $adjacents);
									?>

								</nav>

							</td>

						</tr>

				</tbody>
			
			</table>

		</div>	

	<?php	
	}	
}
?>