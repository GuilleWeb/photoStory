<?php
if(isset($_COOKIE['user']) && !empty($_COOKIE['user'])){
 include('validAcount.php');
 if(xD($_COOKIE['user'])==="false"){
	echo 'Por favor valida tu cuenta para continuar!';
 }else{
	if(isset($_GET['mensajes'])){
		echo "Aqui podras ver tus mensajes enviados y recibidos";
	}
 }
}else{
    header("location://guilleweb.cf/webApp");
}
?>