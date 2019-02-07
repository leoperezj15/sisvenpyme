<?php
	
	/* Connect To Database*/
require_once ("../../../model/conexion.php");

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax')
{
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables=" compra t1";
    $campos="t1.idCompra,
    t1.fechayHoraIngreso,
    t2.nombre,
    t2.Nit,
    concat(t3.nombre,' ',t3.apPaterno ,' ',t3.apMaterno) AS empleado,
    t1.MontoTotal,
    t1.nroFactura";
    $inner="INNER JOIN proveedor t2 ON t2.idProveedor=t1.idProveedor
    INNER JOIN empleado t3 ON t3.idEmpleado=t1.idEmpleado ";
	$sWhere=" t1.nroFactura LIKE '%".$query."%' ";
	$sWhere.=" order by idCompra";
	
	//include("../config/pagination.php;");
	//include "../config/pagination.php"; //include pagination file
	include("../config/pagination.php");
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
    $count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables where $sWhere ");
    
    if ($row= mysqli_fetch_array($count_query))
    {
        $numrows = $row['numrows'];
    }
    else 
    {
        echo mysqli_error($con);
    }
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
						<th>Fecha</th>
						<th>Proveedor</th>
						<th>Nit</th>
						<th>Empleado</th>
                        <th>Monto Total</th>
                        <th>Nro Factura</th>
                        <th>Acciones</td>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
                            $idcompra=$row['idCompra'];
                            $fecha=$row['fechayHoraIngreso'];
                            $proveedor=$row['nombre'];
                            $nit=$row['Nit'];
							$empleado=$row['empleado'];
							$montototal=$row['MontoTotal'];
                            $nrofactura=$row['nroFactura'];			
							$finales++;
						?>	
						<tr class=" small"><!--<?php //echo $text_class;?>-->
							<td class='text-center'><strong><?php echo $idcompra;?></strong></td>
							<td><?php echo $fecha;?></td>
							<td><strong><?php echo $proveedor;?></strong></td>
                            <td><?php echo $nit;?></td>
							<td><?php echo $empleado;?></td>
                            <td><?php echo $montototal;?></td>
                            <td><?php echo $nrofactura;?></td>
							<td>
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<a href="#"  data-target="#editProductoModal" class="edit btn btn-warning" data-toggle="modal" >
                                    
									<i class="fas fa-print"></i>

									</a>
									<a href="#deleteProductoModal" class="delete btn btn-danger" data-toggle="modal" 
									    data-idcompra="<?php echo $idcompra;?>"><i class="fas fa-eraser"></i></a>
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