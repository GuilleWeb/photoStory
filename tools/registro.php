<?php
//include("myCodef.php");

$result="";

function ran($l) { 

return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $l); 

}

$code=ran(6);

if(	isset($_POST['nombre']) && !empty($_POST['nombre']) &&

	isset($_POST['correo']) && !empty($_POST['correo']) &&

	isset($_POST['pass']) && !empty($_POST['pass']) &&

	isset($_POST['pass1']) && !empty($_POST['pass1']) ){

	$nombre=ucwords($_POST['nombre']);

	$correo=base64_encode($_POST['correo']);

	$contra=password_hash($_POST['pass'],PASSWORD_BCRYPT);

	$contra1=$_POST['pass1'];

	///$contra=myCode($contra,'');

	//$contra1=myCode($contra1,'');

	$error=0;

	if( password_verify($contra1,$contra) ){

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

		        			$error++;

		    			}

		    			if($registro[1]===$nombre) {

		        			$error++;

		    			}

		 			}
		 			$path="../usuarios/".str_replace(" ","_",$nombre);
		 			if(mkdir($path)){
		 			 //echo "carpeta creada<br>";
		 			 if(fopen($path."/fav.txt","a+") && fopen($path."/index.php","a+") && fopen($path."/style.json","a+")){
		 			  //echo "fav creado e index <br>";
		 			  if(copy("../usuarios/index.php",$path."/index.php")){
		 			    //  echo "copiado index";
		 			  }else{
		 			      echo "error copy";
		 			  }
		 			 }else{
		 			   $error++;
		 			 }
		 			 
		 			 //$error++;
		 			}else {
		 			   $error++;
		 			}

		 			if($error<1){
						if(mysqli_query($connect, "INSERT INTO $tabla VALUES ('','$nombre','$correo','$contra','$code','false','false','false','')")){

							$result="1";

						}else{

							$result.=mysqli_error($connect);

						}

					}else{
						$result.="el correo, o nombre ya esta registrado, si crees te has registrado antes, presiona recuperar contraseña.";

					}



				}else{

					$result.=mysqli_error($connect);

				}

			}else{
			 $result.=mysqli_error($connect);
			}
		}else{
			$result.=mysqli_error($connect);
		}
	}else{
		$result.="las contraseñas no coinciden";
	}
}else{
	$result="faltan datos";
}
if($result===1 || $result==="1"){
$name1=str_replace(" ","_",$nombre);

echo "<script>
prompt('La funcion de validacion por correo aun no funciona, Tu codigo es, podras verlo en la consola web mas tarde.','".$code."');
console.log('Tu codigo es: ".$code."');
load(1,'".$name1."','".$contra."');
</script> Completando Registro...!";
}else{

	echo $result;

}

?>