<?php
class Pedido
{
	private $idpedido;
	private $nombre_pedido;
	private $cantidad;
	
	private $producto;
	private $Conexion;
	private $proveedor;

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

	

	public function getproducto()
	{
		return $this->producto;
	}
	public function getidProveedor()
	{
		return $this->proveedor;
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



	public function setproducto($newVal)
	{
		$this->producto = $newVal;

	}
	public function setidProveedor($newVal)
	{
		$this->proveedor = $newVal;
	}



	public function crearPedido($producto, $cantidad, $proveedor)
	{

		$this->producto = $producto;
		$this->cantidad = $cantidad;
		$this->proveedor = $proveedor;
	}

	public function agregarPedido()
	{
		$this->Conexion = Conectarse();
		$sql = "insert into pedido (Cantidad,idProveedor,id_Productos) 
        values ('$this->cantidad','$this->proveedor','$this->producto')";
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
