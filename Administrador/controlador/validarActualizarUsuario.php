<?php
require "../modelo/db.php";
require "../modelo/Usuario.php"; 
extract ($_REQUEST);
$objConexion=Conectarse();

$sql="update usuarios set Nom_usuario = '$_REQUEST[nom_usuario]', Ape_usuario = '$_REQUEST[ape_usuario]'

where idUsuarios = '$_REQUEST[idusuarios]'
";

$resultado=$objConexion->query($sql);

if ($resultado)
	header("location: listarUsuarios.php?x=1");  
else
	header("location: listarUsuarios.php?x=2"); 

?>