<?php
$result="";
if(isset($_POST['vC']) ){
	$errorC=1;
	$errorP=1;
	//$correo=base64_encode($_POST['user']);
	$code=$_POST['vC'];
	$usuario=str_replace("_", " ", $_COOKIE['user']);
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
				if($registro[1]===$usuario) {
				if($registro[4]===$code) {
				$id=$registro[0];
$sql = "UPDATE $tabla SET Valido = 'true' WHERE Id = $id";
if(mysqli_query($connect,$sql)){
$result=1;
}else{
	$result.="no se actualizo";
	$errorC=1;
}
				  $errorP=0;
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
		$result.=" Error ";
	}else{
		if($errorP>0){
			$result.=" No valido";
		}else{
			//$result="1";
		}
	}
}else{
	$result.="Define tu codigo";
}

if($result===1 || $result==="1"){
	echo "<script>
setTimeout(function(){ $('#unVerified').css('display','none'); },3000);
</script> Codigo Verificado!";
}else{
	echo $result;
}
?>