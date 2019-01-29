
    <?php
    require_once("../model/RN_Categoria.php");
    require_once("../model/RN_SubCategoria.php");
    require_once("../model/RN_UnidadMedida.php");
    
    $oRN_Categoria = new RN_Categoria;
    $oRN_SubCategoria = new RN_SubCategoria;
    $oRN_UnidadMedida = new RN_UnidadMedida;
    
    $listarCategorias = $oRN_Categoria->GetListCategoria();
    // Un select de Categoria
    $idCategoria="";
    $cboCategoria = "<select class='custom-select' id='comboCategoria' onchange='GetListSubCategoria(this)'>";
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

    $cboSubCategoria = "<select class='custom-select' name='comboSubCategoria' id='comboSubCategoria'>";
    foreach ($listarSubCategorias as $item2)
    {
        $cboSubCategoria.= "<option value='".$item2->idsubCategoria->GetValue()."'>" . $item2->nombre->GetValue() . "</option>";
    }
    $cboSubCategoria.= "</select>";

    //Select de Unidad de Medida

    $listarUnidadMedida = $oRN_UnidadMedida->GetListUnidadMedida();
    $cboUnidadMedida = "<select class='custom-select' name='comboUnidadMedida' id='comboUnidadMedida'>";
    foreach($listarUnidadMedida as $item3)
    {
        $cboUnidadMedida .= "<option value='".$item3->idunidadMedida->GetValue()."'>".$item3->nombre->GetValue()." - " . $item3->abrev->GetValue() . "</option>";
    }
    $cboUnidadMedida .= "</select>";

    
    
    ?>
    <!--Aqui empieza HTML5-->
    <div class="container">

        <div class="shadow-lg p-3 mb-5 bg-white rounded">

            <div class="table-wrapper">

                <div class="table-title">

                    <div class="row">

                        <div class="col-sm-6">

                            <h2>Administrar <b>Productos</b></h2>

                        </div>
                        <div class="col-sm-6">

                            <a href="#addProductoModal" class="btn btn-success" data-toggle="modal">

                                <span>Agregar Nuevo Producto</span>

                            </a>

                        </div>


                    </div>

                </div>
                <div class='col-sm-4 pull-right'>

                    <div id="custom-search-input">

                        <div class="input-group col-md-12">

                            <input type="text" class="form-control" placeholder="Buscar"  id="q" onkeyup="load(1);" />

                            <span class="input-group-btn">

                                <button class="btn btn-info" type="button" onclick="load(1);">

                                    <i class="fas fa-search"></i>Buscar

                                </button>

                            </span>

                        </div>

                    </div>

                </div>

                <div class='clearfix'></div>

                <hr>

                <div id="loader"></div><!-- Carga de datos ajax aqui -->
                <div id="resultados"></div><!-- Carga de datos ajax aqui -->
                <div class='outer_div'></div><!-- Carga de datos ajax aqui -->

            </div>

        </div>



        </div>
        <!-- Edit Modal HTML -->
        <?php include("view/producto/modal_add.php");?>
        <!-- Edit Modal HTML -->
        <?php include("view/producto/modal_edit.php");?>
        <!-- Delete Modal HTML -->
        <?php include("view/producto/modal_delete.php");?>

        <script src="view/js/producto/producto.js"></script>
    <!--Aqui termina HTML5-->