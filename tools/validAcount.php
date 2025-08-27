<?php
if(isset($_COOKIE['user'])){
function xD($idU){
 if(isset($_COOKIE['user'])){
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
		 if($registro[1]===$idU){
			$valid=$registro[5];
			}
		    $errorC=0;
         }
	  }
	}
   }else{
	$result.="Error de host";
   }
 }
if(isset($valid)){
return $valid;
}
}
}else{
    header("location://guilleweb.cf/webApp");
}
?>