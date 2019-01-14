<?php
	
	/* Connect To Database*/
require_once ("../../../model/conexion.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax')
{
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="almacen";
	$campos="*";
	$sWhere=" Nombre LIKE '%".$query."%' ";
	$sWhere.=" order by Nombre ";
	
	
	include 'pagination.php'; //include pagination file
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
	$query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data
	
	if ($numrows>0){
		
	?>
		<div class="table-responsive">
			<table class="table table-sm table-striped table-hover ">
				<thead>
					<tr>
						<th class='text-center'>Código</th>
						<th>Nombre</th>
						<th>Sigla</th>
						<th>idSucursal</th>
						<th>Operacion</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$idAlmacen=$row['idAlmacen'];
							$Nombre=$row['Nombre'];
							$Sigla=$row['Sigla'];
							$idSucursal=$row['idSucursal'];						
							$finales++;
						?>	
						<tr class="<?php echo $text_class;?>">
							<td class='text-center'><?php echo $idAlmacen;?></td>
							<td><?php echo $Nombre;?></td>
							<td><?php echo $Sigla;?></td>
							<td><?php echo $idSucursal;?></td>
							<td>
								<a href="#"  data-target="#editAlmacenModal" class="edit btn btn-warning" data-toggle="modal" data-idAlmacen='<?php echo $idAlmacen;?>' data-nombre="<?php echo $Nombre?>" data-sigla="<?php echo $Sigla?>" data-sucursal="<?php echo $idSucursal?>"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i>Editar</a>
								<a href="#deleteAlmacenModal" class="delete btn btn-danger" data-toggle="modal" data-idAlmacen="<?php echo $idAlmacen;?>"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i>Eliminar</a>
                    		</td>
						</tr>
						<?php }?>
						<tr>
							<td colspan='6'> 
								<?php 
									$inicios=$offset+1;
									$finales+=$inicios -1;
									echo "Mostrando $inicios al $finales de $numrows registros";
									echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
				</tbody>			
			</table>
		</div>	

	
	
	<?php	
	}	
}
?> 