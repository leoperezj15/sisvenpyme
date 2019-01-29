<div class="modal fade bs-example-modal-lg" id="modal_add_producto_compra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
            </div>
            <div class="modal-body">

                <!-- <form class="form-horizontal">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="q" placeholder="Buscar productos" onkeyup="load(1)">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-warning form-control" onclick="load(1)"><i class="fas fa-search"></i></span> Buscar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="loader" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div> Carga gif animado
                <div class="outer_div" ></div>Datos ajax Final -->
                <input type="hidden" id="add_idproducto">



                <label for="add_nombre">Nombre</label>
                <input type="text" id="add_nombre">


                <label for="add_codigo">Codigo</label>
                <input type="text" id="add_codigo">

               

                <label for="add_descripcion">Descripcion</label>
                <input type="text" id="add_descripcion">

                <label for="add_modelo">Modelo</label>
                <input type="text" id="add_modelo">

                <label for="add_cantidad">Cantidad</label>
                <input type="text" id="add_cantidad">

                <label for="add_precio">Precio</label>
                <input type="text" id="add_precio">




            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>
