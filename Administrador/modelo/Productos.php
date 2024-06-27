<?php

class Producto
{
    private $idproductos;
    private $nomProductos;
    private $estado;
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

    public function getEstado()
    {
        return $this->estado;
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

    public function setEstado($newVal)
    {
        $this->estado = $newVal;
    }


    public function setCategoria($newVal)
    {
        $this->categoria = $newVal;
    }

    public function setProveedor($newVal)
    {
        $this->proveedor = $newVal;
    }

    public function crearProducto($nomProductos,  $estado,  $categoria, $proveedor)
    {
        $this->nomProductos = $nomProductos;
        $this->estado = $estado;
        $this->categoria = $categoria;
        $this->proveedor = $proveedor;
    }

    public function agregarProducto()
    {
        $this->Conexion = Conectarse();
        $sql = "INSERT INTO productos (nomProductos, Estado, idCategoria, IDproveedor) 
            VALUES ('$this->nomProductos', '$this->estado', '$this->categoria', '$this->proveedor')";
        $resultado = $this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }


    public function modificarProducto($idproductos)
    {
        $this->Conexion = Conectarse();
        $sql = "UPDATE productos 
        SET idProductos=$this->idproductos', nomProductos='$this->nomProductos', Estado='$this->estado, idCategoria= '$this->categoria',IDproveedor= '$this->proveedor'
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
