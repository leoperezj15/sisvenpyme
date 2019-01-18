


<div class="container">
<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Administrar <b>Almacenes</b></h2>
                </div>
                <div class="col-sm-6">
                    <a href="#addAlmacenModal" class="btn btn-success" data-toggle="modal"><span>Agregar Nuevo Almacen</span></a>
                </div>
            </div>
        </div>
        <div class='col-sm-4 pull-right'>
            <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control" placeholder="Buscar"  id="q" onkeyup="load(1);" />
                            <span class="input-group-btn">
                                <button class="btn btn-info" type="button" onclick="load(1);">
                                    <span class="glyphicon glyphicon-search">Buscar</span>
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
<?php include("view/almacen/modal_add.php");?>
<!-- Edit Modal HTML -->
<?php include("view/almacen/modal_edit.php");?>
<!-- Delete Modal HTML -->
<?php include("view/almacen/modal_delete.php");?>
<script src="view/js/almacen/almacen.js"></script>