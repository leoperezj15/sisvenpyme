<div class="container">
<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Registro de Compras</h2>
                </div>
                <div class="col-sm-6">
                    <a href="?mnu=c-compras-new" class="btn btn-success"><span>Nueva Compra</span></a>
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
<script src="view/js/compra/compra.js"></script>