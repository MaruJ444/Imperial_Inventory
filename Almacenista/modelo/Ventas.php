<?php
class Venta
{
    Private $idventas;
    Private $nombre;
    Private $salidas;
    Private $fecha_salida;
   
    Private $producto;
    private $Conexion;


    public function getidVentas()
    {
        return $this->idventas;
    }


    public function getNombre()
    {
        return $this->nombre;
    }


    public function getSalidas()
    {
        return $this->salidas;
    }


    public function getFecha_salida()
    {
        return $this->fecha_salida;
    }
    public function getproducto()
    {
        return $this->producto;
    }
   
    public function setidVentas($newVal)
    {
        $this->idventas = $newVal;
    }


    public function setNombre($newVal)
    {
        $this->nombre = $newVal;
    }


    public function setSalidas($newVal)
    {
        $this->salidas = $newVal;
    }


    public function setFecha_salida($newVal)
    {
        $this->fecha_salida = $newVal;
    }
    public function setproducto($newVal)
    {
        $this->producto = $newVal;
    }
   


    public function crearVenta($producto,$salidas,$fecha_salida)
    {
        $this->producto=$producto;
        $this->salidas=$salidas;
        $this->fecha_salida=$fecha_salida;
       
    }
   
    public function agregarVenta()
    {    
        $this->Conexion=Conectarse();
        $sql= "insert into ventas (Nombre_producto,Salidas,Fecha_salida)
        values ('$this->producto','$this->salidas','$this->fecha_salida')";
        $resultado=$this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;
    }


    public function modificarVenta($idventas)
    {  
        $this->Conexion=Conectarse();
        $sql="update ventas set idVentas=$this->idventas', Nombre=$this->producto', Salidas='$this->salidas',Fecha_salida='$this->fecha_salida', where idVentas = '$this->idventas";
        $resultado=$this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;  
    }


    public function eliminarVenta($idventas)
    {
        $this->Conexion=Conectarse();
        $sql="delete from ventas where idVentas = '$this->idventas";
        $resultado=$this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;  
    }


    public function consultarVenta()
    {
        $this->Conexion=Conectarse();
        $sql="select * from ventas";
        $resultado=$this->Conexion->query($sql);
        $this->Conexion->close();
        return $resultado;  


    }
   
}  
?>
