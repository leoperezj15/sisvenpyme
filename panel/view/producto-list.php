
    <?php
    require_once("../model/RN_Categoria.php");
    require_once("../model/RN_SubCategoria.php");
    require_once("../model/RN_UnidadMedida.php");
    
    $oRN_Categoria = new RN_Categoria;
    $oRN_SubCategoria = new RN_SubCategoria;
    $oRN_UnidadMedida = new RN_UnidadMedida;
    
    $listarCategorias = $oRN_Categoria->GetListCategoria();
    // Un select de Categoria
    $cboCategoria = "<select id='comboCategoria' onchange='GetListSubCategoria(this)'>";
    foreach ($listarCategorias as $item) 
    {
        if($idCategoria == "")
        {
            $idCategoria = $item->idCategoria->GetValue();
        }
        $cboCategoria.= "<option value='".$item->idCategoria->GetValue()."'>" . $item->nombre->GetValue() . "</option>";
    }
    $cboCategoria.= "</select>";
    //Select de Sub Categoria
    $listarSubCategorias = $oRN_SubCategoria->GetListSubCategoriaByCategoria($idCategoria);

    $cboSubCategoria = "<select id='comboSubCategoria'>";
    foreach ($listarSubCategorias as $item2)
    {
        $cboSubCategoria.= "<option value='".$item2->idsubCategoria->GetValue()."'>" . $item2->nombre->GetValue() . "</option>";
    }
    $cboSubCategoria.= "</select>";

    //Select de Unidad de Medida

    $listarUnidadMedida = $oRN_UnidadMedida->GetListUnidadMedida();
    $cboUnidadMedida = "<select id='comboUnidadMedida'>";
    foreach($listarUnidadMedida as $item3)
    {
        $cboUnidadMedida .= "<option value='".$item3->idunidadMedida->GetValue()."'>".$item3->nombre->GetValue()." - " . $item3->abrev->GetValue() . "</option>";
    }
    $cboUnidadMedida .= "</select>";

    
    
    ?>
    <div class="container">
        <form action="" method="post"> <!-- Opcional para recivir foto se debe de agregar ectypy="multipart" -->
            <!-- (label{lbl$}+input[name="txt$" placeholder="" id="txt$" require]+br)*6   //ojo para crear label + input y br de forma mas rapida-->
            <!-- Aqui incorporamos el modal para ingresar,actualizar y eliminar usuario -->
            <!-- Button trigger modal -->
            <h1>Lista de Productos</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Agregar Producto
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registro de Nuevo Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aqui ponemos los campus y botones del formulario -->
                        <div class="form-row"><!-- esta es una clase para form en modal-->

                            <div class="form-group col-md-6">
                            <label for="">Nombre(s)</label>
                            <input type="text" class="form-control" name="nombre" placeholder="" id="nombre" require="" required>
                            </div><br>
                            

                            <div class="form-group col-md-6">
                            <label for="">Descripcion</label>
                            <input type="text" class="form-control" name="apPaterno" placeholder="" id="apPaterno" require="" required>
                            </div>
                            

                            <div class="form-group col-md-6">
                            <label for="">Modelo</label>
                            <input type="text" class="form-control" name="apMaterno" placeholder="" id="apMaterno" require="" required>
                            </div>
                            

                            <div class="form-group col-md-6">
                            <label for="">Peso</label>
                            <input type="number" class="form-control" name="fechaNacimiento" placeholder="" id="FechaNacimiento" require="" required>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="">Precio de Compra</label>
                            <input type="number" class="form-control" name="fechaNacimiento" placeholder="" id="FechaNacimiento" require="" required>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="">Precio de Venta</label>
                            <input type="number" class="form-control" name="fechaNacimiento" placeholder="" id="FechaNacimiento" require="" required>
                            </div>
                            

                            <div class="form-group col-md-6">
                            <label for="">Origen de Producto</label>
                            <select name="madein" id="madein">
                                <option value="USA">USA</option>
                                <option value="Brasil">Brasil</option>
                                <option value="China">China</option>
                                <option value="Vietnan">Vietnan</option>
                                <option value="Korea del Sur">Korea del Sur</option>
                                <option value="Japon">Japon</option>
                            </select>
                            </div>

                            <div class="form-group col-md-8">
                            <label for="">Seleccione Categoria</label>
                            <?php echo $cboCategoria;?>
                            </div>

                            <div class="form-group col-md-8" id="ctn-SubCategoria">
                            <label for="">Selecione SubCategoria</label>
                            <?php echo $cboSubCategoria;?>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="">Selecione Unidad de Medida</label>
                            <?php echo $cboUnidadMedida; ?>
                            </div>
                            
                        </div>
                        

                        <!-- (button[value="btn$" type="submit" name="accion"])*4  //para crear botones de forma rapida X 4-->
                        
                    </div>
                    <div class="modal-footer">
                        <button value="btnAgregar" type="submit" name="accion"class="btn btn-success">Agregar</button>
                        <button value="btnActualizar" type="submit" name="accion" class="btn btn-warning">Actualizar</button>
                        <button value="btnEliminar" type="submit" name="accion" class="btn btn-danger">Eliminar</button>
                        <button value="btnCancelar" type="submit" name="accion" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
                </div>
            </div>
            

        </form>
        <br>
        <div class="shadow-lg p-3 mb-5 bg-white rounded"><!--Cajon con sombrita-->
            <div class="row">
                <!-- table>thead>tr>(th)*4 de forma rapida ayuda a crear una tabla que contenga un thead un tr y 4 th-->
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Deescripcion</th>
                                <th scope="col">SubCategoria</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                    echo "";     
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
    </div>