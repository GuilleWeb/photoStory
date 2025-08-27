<?php
//usuarios/Guillermo_Palma/profileFoto.png
//include("myCodef.php");
$result="";
if(isset($_POST['user']) && !empty(trim($_POST['user'])) && isset($_POST['contra']) && !empty(trim($_POST['contra'])) ){
	$errorC=1;
	$errorP=1;
	$correo=base64_encode($_POST['user']);
	$contra=$_POST['contra'];
	$host="sql305.infinityfree.com";
        $user="if0_39766672";
        $pass="Guilleweb042";
        $DB="if0_39766672_webAppUsers";
	$tabla="usuariosPS";
	$connect=mysqli_connect($host,$user,$pass);
	$db=mysqli_select_db($connect,$DB);
	if($connect){
		if($db){
			$query = "select * from $tabla";
		 		if($resultado =mysqli_query($connect,$query)){
		    		while($registro = mysqli_fetch_row($resultado)){ 
				if($registro[2]===$correo) {
					$contrax=$registro[3];
				if(password_verify($contra,$contrax)){
				  $errorP=0;
				  $nombre=$registro[1];
				}
				  $errorC=0;

				}

		 	 }
		  }
		}
	}else{
		$result.="Error de host";
	}
	if($errorC>0){
		$result.=" El correo no es correcto ";
	}else{
		if($errorP>0){
			$result.=" La contraseña no es correcta ";
		}else{
			$result="1";
		}
	}
}else{
	$result.="Faltan datos";
}
if($result===1 || $result==="1"){
	$name1=str_replace(" ","_",$nombre);
	echo ' Ingresando...!<script>
	 load(1,"'.$name1.'","'.$contrax.'"); location.reload();
	</script>';
}else{
	echo $result;
}
?>