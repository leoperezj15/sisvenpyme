<?php


if(isset($_POST["idSucursal"]))
{
    if(!empty($_POST["idSucursal"]))
    {
        $idSucursal = intval($_POST["idSucursal"]);

        require "../../../model/RN_Almacen.php";

        $oRN_Almacen = new RN_Almacen;

        $listaAlmacen = $oRN_Almacen->listarAlmacenPorSucursal($idSucursal);

        $selectAlmacen = "
        <label for='almacen'>Almacen</label>
            <select name='compra_add_almacen' id='almacen' class='form-control'>";
        foreach ($listaAlmacen as $item2) {
            $selectAlmacen .= "<option value='". $item2->idAlmacen->GetValue() ."'>". $item2->Nombre->GetValue() ."</option>";
        }
        $selectAlmacen .= "</select>
        <div class='invalid-feedback'>
                porfavor selecione un almacen.
        </div>
        ";

        echo $selectAlmacen;
    }
}

?>