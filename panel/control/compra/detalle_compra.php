<?php
session_start();
$contenido = "";

if(isset($_POST["fn"]))
{
    $fn = $_POST["fn"];
    switch ($fn) {
        case 'AddItem':
            addItem();
        break;
        case 'DeleteListItems':
            DeleteListItems();
        break;
    }
}

function addItem()
{
    $idproducto = $_POST['idproducto'];
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $lista = array();

    $existe = false;

    if( isset($_SESSION['lista']))
    {
        $lista = $_SESSION['lista'];

        for($i = 0; $i < count($lista); $i++)
        {
            if($lista[$i]['idproducto'] == $idproducto)
            {
                $existe = true;
                $lista[$i]['cantidad'] = $lista[$i]['cantidad'] + $cantidad;
            }
        }
    }
    
    if($existe == false)
    {
        $item = array("idproducto" => $idproducto, 
        "nombre" => $nombre, 
        "codigo" => $codigo, 
        "descripcion" => $descripcion,
        "modelo" => $modelo,
        "cantidad" => $cantidad,
        "precio" => $precio);

        $lista[] = $item;
    }

    $_SESSION['lista'] = $lista;

    $contenido = "
    <table class='table table-resposible small'>
        
        <thead class='table-dark'>

            <tr>

                <th>#</th>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Sub total</th>
                <th>Quitar</th>

            </tr>

        </thead>

        <tbody>

    ";
    $c = 0;
    $total = 0;
    foreach($lista as $item)
    {
        $c++;
        $itemPrecio=$item['precio'];
        $itemCantidad=$item['cantidad'];

        $subTotal = $itemPrecio * $itemCantidad;
        $total += $subTotal;

        $contenido.= "
        
            <tr>
                <td>      ".$c."      </td>
                <td><strong>     ".$item['codigo']."      </strong></td>
                <td><strong>       ".$item['nombre']." ".$item['descripcion']." ".$item['modelo']."    </strong></td>
                <td>      ".$itemCantidad."      </td>
                <td>      ".number_format($itemPrecio,2)."      </td>
                <td>      ".number_format($subTotal,2)."      </td>
                <td> <a href='#deleteProductoCompraModal' class='delete btn btn-primary' data-toggle='modal'
                data-idproducto=' ".$item['idproducto']."'><i class='far fa-trash-alt'></i></a></td>
            </tr>
            
        
        ";
        

    }
    $contenido.="
        
        <td class='text-right' colspan=5><strong>TOTAL Bs<strong></td>
        <td class='text-right'>".number_format($total,2)."</td>
        <td></td>
        
        ";
    $contenido.= "
        </tbody>
    </table>";
    echo $contenido;
}
function DeleteListItems()
{
    $_SESSION["lista"] = null;
    $contenido = "
    <table class='table table-resposible small'>
        
        <thead class='table-dark'>

            <tr>

                <th>#</th>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Sub total</th>
                <th>Quitar</th>

            </tr>

        </thead>

        <tbody>
            <tr><td colspan='6'>No hay nada en lista</td></tr>
        </tbody>
    </table>

    ";
    echo $contenido;
}

?>