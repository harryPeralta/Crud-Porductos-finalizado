<?php

class Producto
{
    private $db;
    private $productos;

    public function __construct()
    {
        $this->db = Conectar::conexion();
        $this->productos = array();
    }

    public function listar()
    {
        $sql =  "SELECT producto.id, producto.nombre , marca.nombre AS nombreMarca " .
                "FROM producto " .
                "JOIN marca " . 
                "ON producto.idMarca = marca.id ".
                "ORDER BY producto.id asc";
                $resultado = $this->db->query($sql);
        if(!$resultado)
        {
            echo "Lo sentimos este sitio está experimentndo problemas.\n\n";

            echo "Eror: La ejecución de la consulta falla debido a :\n";
            echo "Query : " . $sql . "\n";
            echo "Errno" . $mysqli->errno . "\n" ;
            echo "Error" . $mysqli->error . "\n" ;
            exit;
        }

        while ($row = $resultado->fetch_assoc())
        {
            $this->productos[] = $row;
        }
        return $this->productos;
    }

    public function insert($nombre, $precio, $cantidad, $idMarca)
    {
        $sql = "INSERT INTO producto  (nombre, precio, cantidad, idMarca) VALUES ('$nombre', $precio, $cantidad, $idMarca)";
        $this->db->query($sql);
    }

    public function update($id, $nombre, $precio, $cantidad, $idMarca)
    {
        $sql ="UPDATE producto SET nombre = '$nombre', precio = $precio, cantidad = $cantidad, idMarca = $idMarca WHERE id = $id";
        $resultado = $this->db->query($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM producto WHERE id = $id";
        $resultado = $this->db->query($sql);
    }

    public function view($id)
    {
        $sql = "SELECT FROM producto WHERE id = $id";
        $resultado = $this->db->query($sql);
    }

    public function getProducto($id)
    {
        $sql = "SELECT producto.id, producto.nombre, producto.precio, producto.cantidad, producto.idMarca, marca.nombre AS nombreMarca " .
        "FROM producto " . 
        "JOIN marca " . 
        "ON producto.idMarca = marca.id " .
        "WHERE producto.id = $id";
        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }
}

?>