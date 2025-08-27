<?php
if(isset($_COOKIE['user'])){
include('validAcount.php');
if(xD($_COOKIE['user'])==="false"){
	echo 'Por favor valida tu cuenta para continuar!';
}else{
 $host="sql305.infinityfree.com";
        $user="if0_39766672";
        $pass="Guilleweb042";
        $DB="if0_39766672_webAppUsers";
 $tabla="usuariosPS";
 $connect=mysqli_connect($host,$user,$pass);
 $db=mysqli_select_db($connect,$DB);
 $userNick=$_COOKIE['user'];
 if(isset($_GET['id'])){
 $UserID=$_GET['id'];
 }else{
  $UserID=null;
 }
 if($connect){
  if($db){
  if(isset($_POST['passOld']) && !empty(trim($_POST['passOld']))){
  $queryH = "select * from $tabla WHERE Id = $UserID";
 if($resultado =mysqli_query($connect,$queryH)){
   $row=mysqli_fetch_row($resultado);
   if(password_verify($_POST['passOld'],$row[3])){
     if( isset($_POST['pass']) && !empty(trim($_POST['pass']))  ){
     $contra=$_POST['pass'];
     if(isset($_POST['pass2']) && !empty(trim($_POST['pass2'])) ){
         $contra2=$_POST['pass2'];
         if($contra===$contra2){
            $contra=password_hash($contra,PASSWORD_BCRYPT);
            $sQLU=" UPDATE $tabla SET Contraseña = '$contra' WHERE Id = $UserID";
            if(mysqli_query($connect,$sQLU)){
              echo "La contraseña se cambio exitosamente, puedes continuar modificando tu ceunta o presiona aqui para regrescar <button onclick='location.reload();'>Recargar</button>";
            }else{
               echo "Error al actualizar contraseña, si este problema persiste ponte en contacto con los administradores.";
            }
         }else{
             echo "las contraseñas no coinciden";
         }
     }else{
         echo "La contraseña 2 no se escribio";
     }
      }else{
         echo "Escribe tu nueva contraseña";
      }
    }else{
      echo "Tu contraseña actual no es correcta";
    }
  }else{
      echo "Error al obtener contraseña actual";
  }
 }
   if(isset($_POST['info']) && !empty(trim($_POST['info'])) ){
    $info=$_POST['info'];
    $sQLU=" UPDATE $tabla SET Descr = '".base64_encode($info)."' WHERE Id = $UserID";
            if(mysqli_query($connect,$sQLU)){
              echo "Tu descripcion de perfil se actualizo con exito!
              <script> $('#body').load('tools/perfil.php?profile=".base64_encode($_COOKIE['user'])."'); </script>";
            }else{
               echo "Error al actualizar descripcion, si este problema persiste ponte en contacto con los administradores.";
            }
 }
if(isset($_GET['changeFoto']) ){
 if(isset($_FILES["photo"]) ){
  $userP = str_replace(' ','_',$userNick);
  $fileN=$_FILES["photo"]['name'];
  $fileT=$_FILES["photo"]['type'];
  $fileS=$_FILES["photo"]['size'];
  $ruta="../usuarios/$userP/";
  $fileP=$_FILES["photo"]['tmp_name'];
  $ext=['image/png','image/jpg','image/gif','image/jpeg'];
  for($c=0;$c<count($ext);$c++){
    if($fileT===$ext[$c]){
      $nExt=substr($ext[$c],6,4);
      $yes=true;
    }
  }
  if(!isset($yes)){
      echo "2";
  }else{
      //echo "si se admite este archivo";
      $mover = move_uploaded_file($fileP,$ruta.'profile_pic.'.$nExt);
      if($mover){
         // echo " \n se movio a la nueva ruta \n";
          if(is_file($ruta.'profile_pic.'.$nExt)){
             $photo='usuarios/'.$userP.'/profile_pic.'.$nExt;
             $sQLU=" UPDATE $tabla SET Foto = '$photo' WHERE Id = $UserID";
             if(mysqli_query($connect,$sQLU)){
                 echo "1";
             }else{
                 echo "0";
             }
          }
      }else{
          echo "0";
      }
  }
 }else{
    echo "2";
 }

}
  }else{
      echo mysqli_error($connect);
  }
mysqli_close($connect);
 }else{
      echo mysqli_error($connect);
  }
}
}else{
    header('location://guilleweb.cf');
}
?>