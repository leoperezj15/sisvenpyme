<div class="container">

    <div class="shadow-lg p-3 mb-5 bg-white rounded">

        <div class="table-wrapper">

            <div class="table-title">

                <div class="row">

                    <div class="col-sm-6">

                        <h2>Administrar <b>Proveedores</b></h2>

                    </div>
                    <div class="col-sm-6">

                        <a href="#addProveedorModal" class="btn btn-success" data-toggle="modal">

                            <span>Agregar Nuevo Proveedor</span>

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
    

    <nav>
        <ul class="pagination">
            <li class="active">
                <a href="">anterior</a>
            </li>
            <li class="active page-item">
                <a href="">1</a>
            </li>
            <li class="active page-item">
                <a href="">siguiente</a>
            </li>
        </ul>
    
    </nav>

    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">2 
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>





</div>
<!-- Edit Modal HTML -->
<?php include("view/proveedor/modal_add.php");?>
<!-- Edit Modal HTML -->
<?php include("view/proveedor/modal_edit.php");?>
<!-- Delete Modal HTML -->
<?php include("view/proveedor/modal_delete.php");?>

<script src="view/js/proveedor/proveedor.js"></script>