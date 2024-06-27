<?php
function Conectarse()
{
	$Conexion=new mysqli("localhost","root","","imperial_inventory");
	
	if ($Conexion->connect_errno) 
		echo "Problemas en la Conexion ". $Conexion->connect_error;
	else
		return $Conexion;
} 
?>