<?php
class Pedido
{
	private $idpedido;
	private $nombre_pedido;
	private $cantidad;
	private $idproveedor;
	private $producto;
	private $Conexion;

	public function getidPedido()
	{
		return $this->idpedido;
	}

	public function getNombre_pedido()
	{
		return $this->nombre_pedido;
	}

	public function getCantidad()
	{
		return $this->cantidad;
	}

	public function getidProveedor()
	{
		return $this->idproveedor;
	}
	public function getproducto()
	{
		return $this->producto;
	}


	public function setidPedido($newVal)
	{
		$this->idpedido = $newVal;
	}

	public function setNombre_pedido($newVal)
	{
		$this->nombre_pedido = $newVal;
	}

	public function setCantidad($newVal)
	{
		$this->cantidad = $newVal;
	}

	public function setidProveedor($newVal)
	{
		$this->idproveedor = $newVal;
	}
	public function setproducto($newVal)
	{
		$this->producto = $newVal;
	}


	public function crearPedido($producto, $cantidad, $idproveedor)
	{

		$this->producto = $producto;
		$this->cantidad = $cantidad;
		$this->idproveedor = $idproveedor;
	}

	public function agregarPedido()
	{
		$this->Conexion = Conectarse();
		$sql = "insert into pedido (Cantidad,idProveedor,id_Productos) 
        values ('$this->cantidad','$this->idproveedor','$this->producto')";
		$resultado = $this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;
	}

	public function modificarPedido($idpedido)
	{
		$this->Conexion = Conectarse();
		$sql = "update pedido set idPedido=$this->idpedido',  Cantidad='$this->cantidad',idProveedor='$this->idproveedor',id_Productos='$this->producto', where idPedido = '$this->idpedido";
		$resultado = $this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;
	}

	public function eliminarPedido($idpedido)
	{
		$this->Conexion = Conectarse();
		$sql = "delete from pedido where idPedido = '$this->idpedido";
		$resultado = $this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;
	}

	public function consultarPedido()
	{
		$this->Conexion = Conectarse();
		$sql = "select * from pedido";
		$resultado = $this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;
	}
}
