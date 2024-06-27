<?php

class Producto
{
    private $idproductos;
    private $nomProductos;
    private $cantidad;
    private $estado;
    private $precio;
    private $categoria;
    private $proveedor;
    private $Conexion;

    public function getidProductos()
    {
        return $this->idproductos;
    }

    public function getnomProductos()
    {
        return $this->nomProductos;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getCategoria($newVal)
    {
        $this->categoria = $newVal;
    }

    public function getProveedor($newVal)
    {
        $this->proveedor = $newVal;
    }

    public function setidProductos($newVal)
    {
        $this->idproductos = $newVal;
    }

    public function setnomProductos($newVal)
    {
        $this->nomProductos = $newVal;
    }

    public function setCantidad($newVal)
    {
        $this->cantidad = $newVal;
    }

    public function setEstado($newVal)
    {
        $this->estado = $newVal;
    }

    public function setPrecio($newVal)
    {
        $this->precio = $newVal;
    }

    public function setCategoria($newVal)
    {
        $this->categoria = $newVal;
    }

    public function setProveedor($newVal)
    {
        $this->proveedor = $newVal;
    }

    public function crearProducto($nomProductos, $cantidad, $estado, $precio, $categoria, $proveedor)
    {
        $this->nomProductos = $nomProductos;
        $this->cantidad = $cantidad;
        $this->estado = $estado;
        $this->precio = $precio;
        $this->categoria = $categoria;
        $this->proveedor = $proveedor;
    }

    public function agregarProducto()
    {
        $this->Conexion = Conectarse();
        $sql = "INSERT INTO productos (nomProductos, Cantidad, Estado, Precio, idCategoria, IDproveedor) 
            VALUES ('$this->nomProductos', '$this->cantidad', '$this->estado', '$this->precio', '$this->categoria', '$this->proveedor')";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }


    public function modificarProducto($idproductos)
    {
        $this->Conexion = Conectarse();
        $sql = "UPDATE productos 
        SET idProductos=$this->idproductos', nomProductos='$this->nomProductos', Cantidad='$this->cantidad', Estado='$this->estado, Precio='$this->precio', idCategoria= '$this->categoria',IDproveedor= '$this->proveedor'
        WHERE idProductos = '$idproductos'";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    public function eliminarProducto($idproductos)
    {
        $this->Conexion = Conectarse();
        $sql = "DELETE FROM productos WHERE idProductos = '$idproductos'";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }

    public function consultarProductos()
    {
        $this->Conexion = Conectarse();
        $sql = "SELECT * FROM productos";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }
}
