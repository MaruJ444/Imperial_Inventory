<?php

class Categoria
{

	Private $codigo;
	Private $tipo;
	Private $estado;
	private $Conexion;

	public function Categoria()
	{
		
	}

	public function getCodigo()
	{
		return $this->codigo;
	}

	public function getTipo()
	{
		return $this->tipo;
	}

	public function getEstado()
	{
		return $this->estado;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setCodigo($newVal)
	{
		$this->codigo = $newVal;
	}


	/**
	 * 
	 * @param newVal
	 */
	public function setTipo($newVal)
	{
		$this->tipo = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setEstado($newVal)
	{
		$this->estado = $newVal;
	}

	
	public function crearCategoria($tipo,$estado)
	{
		$this->tipo=$tipo;
		$this->estado=$estado;
	}
	
	public function agregarCategoria()
	{	
		$this->Conexion=Conectarse();
		$sql="insert into categoria( Tipo, Estado)
		values ('$this->tipo','$this->estado')";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
	}

	public function modificarCategoria($codigo)
	{	
		$this->Conexion=Conectarse();
		$sql="update categoria set Cod_Categoria=$this->codigo', Tipo='$this->tipo', Estado='$this->estado' where Cod_Categoria = '$this->codigo'";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
		}

	public function eliminarCategoria($codigo)
	{	
		$this->Conexion=Conectarse();
		$sql="delete from categoria where Cod_Categoria = '$this->codigo";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
		}


	public function consultarCategorias()
	{
		$this->Conexion=Conectarse();
		$sql="select * from categoria";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
	}
	
	public function consultarCategoria($codigo)
	{
		$this->Conexion=Conectarse();
		$sql="select * from categoria where Cod_Categoria= '$this->codigo)";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
	}

}
?>