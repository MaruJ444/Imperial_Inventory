<?php

class Proveedor
{

	Private $proveedor; 
	Private $nombre;
	Private $telefono;
	Private $direccion;
	Private $email;
	Private $producto; 
	private $estado;
	private $Conexion;

	public function Proveedor()
	{
		
	}

	public function getProveedor()
	{
		return $this->proveedor;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getTelefono()
	{
		return $this->telefono;
	}

	public function getDireccion()
	{
		return $this->direccion;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getProducto()
	{
		return $this->producto;
	}

	public function getEstado()
    {
        return $this->estado;
    }

	
	
	public function setProveedor($newVal)
	{
		$this->proveedor = $newVal;
	}

	
	public function setNombre($newVal)
	{
		$this->nombre = $newVal;
	}

	
	public function setTelefono($newVal)
	{
		$this->telefono = $newVal;
	}

	public function setDireccion($newVal)
	{
		$this->direccion = $newVal;
	}

	
	public function setEmail($newVal)
	{
		$this->email = $newVal;
	}

	public function setProducto($newVal)
	{
		$this->producto = $newVal;
	}

	public function setEstado($newVal)
    {
        $this->estado = $newVal;
    }

	
	public function crearProveedor($nombre,$telefono,$direccion,$email,$producto,$estado)
	{
		$this->nombre=$nombre;
		$this->telefono=$telefono;
		$this->direccion=$direccion;
		$this->email=$email;
		$this->producto=$producto;
		$this->estado=$estado;

	}
	
	public function agregarProveedor()
	{	
		$this->Conexion=Conectarse();
		$sql="insert into proveedor( Nombre, Telefono, Direccion, Email, id_Producto, Estado)
		values ('$this->nombre','$this->telefono','$this->direccion','$this->email','$this->producto','$this->estado')";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
	}

	public function modificarProveedor($proveedor)
	{	
		$this->Conexion=Conectarse();
		$sql="UPDATE proveedor set idProveedor=$this->proveedor', Nombre='$this->nombre', Telefono='$this->telefono', Direccion='$this->direccion', Email='$this->email', id_Producto='$this->producto' , Estado='$this->estado' where idProveedor = '$this->proveedor'";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
		}

	public function eliminarProveedor($proveedor)
	{	
		$this->Conexion=Conectarse();
		$sql="delete from proveedor where idProveedor = '$this->proveedor";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
		}


	public function consultarProveedores()
	{
		$this->Conexion=Conectarse();
		$sql="select * from proveedor";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
	}
	
	public function consultarProveedor($proveedor)
	{
		$this->Conexion=Conectarse();
		$sql="select * from proveedor where idProveedor= '$this->proveedor)";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
	}

}
?>