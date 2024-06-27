<?php
class Usuario
{
    Private $idusuarios;
	Private $nom_usuario;
	Private $ape_usuario;
	Private $rol;
	Private $password;

	private $Conexion;
	
    public function getidUsuarios()
	{
		return $this->idusuarios;
	}

	public function getnNom_usuario()
	{
		return $this->nom_usuario;
	}

	public function getApe_usuario()
	{
	    return $this->ape_usuario;
	}

	public function getRol()
	{
		return $this->rol;
	}

	public function getPassword()
	{
		return $this->password;
	}
    //seter
	public function setidUsuarios($newVal)
	{
		$this->idusuarios = $newVal;
	}

	public function setNom_usuario($newVal)
	{
		$this->nom_usuario = $newVal;
	}

	public function setApe_usuario($newVal)
	{
		$this->ape_usuario = $newVal;
	}

	public function setRol($newVal)
	{
		$this->rol = $newVal;
	}
	public function setPassword($newVal)
	{
		$this->password = $newVal;
	}
	




    
	public function modificarUsuario($idusuarios)
	{	
		$this->Conexion=Conectarse();
		$sql="update usuarios set Nom_usuario='$this->nom_usuario', Ape_usuario='$this->ape_usuario', where idUsuarios = '$this->idusuarios ";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	
	}

    public function consultarUsuario()
	{
		$this->Conexion=Conectarse();
		$sql="select * from usuarios";
		$resultado=$this->Conexion->query($sql);
		$this->Conexion->close();
		return $resultado;	

	}
	
}	
?>