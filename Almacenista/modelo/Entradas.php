<?php
class Entrada
{
    Private $identrada;
	Private $producto;
	Private $fecha_entrada;
	Private $cantidadentrada;
	Private $valorunitario;
	Private $valortotal;
	private $idproducto;

	private $Conexion;
	
    public function getidentrada()
	{
		return $this->identrada;
	}

	public function getproducto()
	{
		return $this->producto;
	}

	public function getfecha_entrada()
	{
		return $this->fecha_entrada;
	}

	public function getcantidadentrada()
	{
	    return $this->cantidadentrada;
	}

	public function getvalorunitario()
	{
		return $this->valorunitario;
	}

	public function getvalortotal()
	{
		return $this->valortotal;
	}

	public function getidproducto()
	{
		return $this->idproducto;
	}
    //seter
	public function setidentrada($newVal)
	{
		$this->identrada = $newVal;
	}

	public function setproducto($newVal)
	{
		$this->producto = $newVal;
	}

	public function setfecha_entrada($newVal)
	{
		$this->fecha_entrada = $newVal;
	}

	public function setcantidadentrada($newVal)
	{
		$this->cantidadentrada = $newVal;
	}

	public function setvalorunitario($newVal)
	{
		$this->valorunitario = $newVal;
	}
	public function setvalortotal($newVal)
	{
		$this->valortotal = $newVal;
	}
	public function setidproducto($newVal)
	{
		$this->idproducto = $newVal;
	}
	


    public function crearEntrada($producto, $fecha_entrada,$cantidadentrada, $valorunitario, $idProducto)
    {
        $this->producto = $producto;
		$this->fecha_entrada = $fecha_entrada;
        $this->cantidadentrada = $cantidadentrada;
        $this->valorunitario = $valorunitario;
		$this->idproducto = $idProducto;
        
    }

	public function agregarcantidadproductos()
	{
		$this->Conexion = Conectarse();
		$sql = "UPDATE productos 
		SET Cantidad = Cantidad + (
			SELECT Cant_entrada 
			FROM entradas 
			WHERE entradas.Producto = productos.nomProductos
		) 
		WHERE productos.idProductos = '$this->idproducto'
		";
		$resultado = $this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;
	}

	public function agregarEntrada()
	{
		$this->Conexion = Conectarse();
		$total = $this->valorunitario * $this->cantidadentrada; 
		$sql = "INSERT INTO entradas (Producto, Fecha_entrada, Cant_entrada, Valor_unitario, Valor_totalentrada) 
				VALUES ('$this->producto', '$this->fecha_entrada', '$this->cantidadentrada', '$this->valorunitario', '$total')";
		$resultado = $this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;
	}



    public function consultarEntrada()
	{
		$this->Conexion=Conectarse();
		$sql="select * from entradas";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	

	}
	
}	
?>