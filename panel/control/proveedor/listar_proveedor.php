<?php
	
	/* Connect To Database*/
require_once ("../../../model/conexion.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax')
{
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="proveedor";
	$campos="*";
	$sWhere=" nombre LIKE '%".$query."%' ";
	$sWhere.=" order by idProveedor ";
	
	//include("../config/pagination.php;");
	include "../config/pagination.php"; //include pagination file
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
			<table class="table table-sm table-striped">
				<thead class="table-dark">
					<tr>
						<th class='text-center'>Código</th>
						<th>Nit</th>
						<th>Nombre</th>
						<th>Contacto</th>
						<th>Direccion</th>
                        <th>Telefono</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th>Pagina Web</th>
                        <th>Operacion</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$idproveedor=$row['idProveedor'];
							$nit=$row['Nit'];
							$nombre=$row['nombre'];
							$contacto=$row['contacto'];
                            $direccion=$row['direccion'];
                            $telefonofijo=$row['telefonoFijo'];
                            $telefonocelular=$row['telefonoCelular'];
                            $correo=$row['correo'];	
                            $paginaweb=$row['paginaWeb'];				
							$finales++;
						?>	
						<tr class=" small"><!--<?php //echo $text_class;?>-->
							<td class='text-center'><strong><?php echo $idproveedor;?></strong></td>
							<td><strong><?php echo $nit;?></strong></td>
							<td><?php echo $nombre;?></td>
							<td><?php echo $contacto;?></td>
                            <td><?php echo $direccion;?></td>
                            <td><?php echo $telefonofijo;?></td>
                            <td><?php echo $telefonocelular;?></td>
                            <td><?php echo $correo;?></td>
                            <td><?php echo $paginaweb;?></td>
							<td>
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<a href="#"  data-target="#editProveedorModal" class="edit btn btn-warning" data-toggle="modal" 
										data-idproveedor="<?php echo $idproveedor;?>"  
										data-nit="<?php echo $nit?>" 
										data-nombre="<?php echo $nombre?>" 
										data-contacto="<?php echo $contacto?>" 
										data-direccion="<?php echo $direccion?>" 
										data-telefonofijo="<?php echo $telefonofijo?>"
										data-telefonocelular="<?php echo $telefonocelular?>"
										data-correo="<?php echo $correo?>"
										data-paginaweb="<?php echo $paginaweb?>"><i class="fas fa-edit"></i>
									</a>
									<a href="#deleteProveedorModal" class="delete btn btn-danger" data-toggle="modal" 
									data-idproveedor="<?php echo $idproveedor;?>"><i class="fas fa-eraser"></i></a>
								</div>
                    		</td>
						</tr>
						<?php }?>
						<tr>
							<td colspan='10'>
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