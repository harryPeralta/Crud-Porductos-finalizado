<?php

class ProductoController
{
    public function __construct()
    {
        require_once "models/Producto.php";
        require_once "models/Marca.php";
    }

    public function index()
    {
        $productos = new Producto();
        $data["productos"] = $productos->listar();
        $data["titulo"] = "Productos";
        //cargar la vista
        require_once "views/productos/index.php";
    }

    //mostrar la vista, para crear un nuevo registro (producto)
    public function insert()
    {
        $marcas = new Marca();
        $data["marcas"] = $marcas->listar();
        $data["titulo"] = " Crear nuevo producto";
        require_once "views/productos/insert.php";
    }

    //guarda el registro
    public function store()
    {
        
        //recibir los datos a aguardar
        $nombre = $_POST['nombre'];
        $idMarca = $_POST['idMarca'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        
        //TODO: Realizar las validacion
        $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";


        if(empty($_POST['nombre']))
        {
            echo'Digite el nombre.';
        }
        else if(!preg_match($patron_texto, $_POST['nombre']) )
            {    
            echo "El nombre sólo puede contener letras y espacios";
            }             
        else
        {
            if( empty($_POST['idMarca']) )
            {
                echo'Digite la marca.';
            }
            else if(!preg_match($patron_texto, $_POST['idMarca']) )
            {    
                echo "La marca sólo puede contener letras y espacios";
            }
            else
            {
                if( empty($_POST['precio']) )
                {
                    echo'Digite el precio.';
                }
                else if( $precio <= 0 )
                {
                    echo 'El precio digitado no es admitido por el sistema';
                }
                else
                {
                    if( empty($_POST['cantidad']) )
                    {
                        echo'Digite la cantidad.';
                    }
                    else if( $cantidad < 1 )
                    {
                        echo 'La cantidad digitada no es admitida por el sistema';
                    }
                    else
                    {
                        $producto = new Producto();  
                        $producto->insert($nombre, $idMarca, $precio, $cantidad);
                        $this->index();           
                    }
                }   
            }
        }
    }
    
    public function edit($id)
    {
        $producto = new Producto();
        $marcas = new Marca();
        //Pasar a la vista el id y el producto
        $data["id"] = $id;
        $data["producto"] = $producto->getProducto($id);
        $data["marcas"] = $marcas->listar();
        $data["titulo"] = "Editar producto";
        require_once "views/productos/edit.php";
    }

    public function update()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $idMarca = $_POST['idMarca'];

        $producto = new Producto();
        $producto->update($id, $nombre, $precio, $cantidad, $idMarca);
        $this->index();
    }
    public function delete($id)
    {
        $producto = new Producto();
        $producto->delete($id);
        $this->index();
    }

    public function view($id)
    {
        $producto = new Producto();
        $data["id"] = $id;
        $data["producto"] = $producto->getProducto($id);
        $data["titulo"] = "Ver producto";
        require_once "views/productos/view.php";
    }
}
?>