<?php 
include('traductor.php');
 $texto=$_POST['texto'];
$or=$_POST['or'];
$de=$_POST['des'];

$traducion = new Traductor($or,$de);
 $texto1 = $traducion->traducir_texto($texto);
 if($texto1==''){
	echo 'no se pudo traducir';
 }
else{
	echo $texto1;		
     }
?>