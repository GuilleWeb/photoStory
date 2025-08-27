<?php
if(isset($_COOKIE['user']) && !empty($_COOKIE['user'])){
 $usuario=str_replace(" ","_",$_COOKIE['user']);
 $host="sql305.infinityfree.com";
 $user="if0_39766672";
 $pass="Guilleweb042";
 $DB="if0_39766672_webAppUsers";
 $ht="publicaciones";
 $connect=mysqli_connect($h,$hu,$hp)or die(mysqli_error($connect));
 $dbc=mysqli_select_db($connect,$hdb)or die(mysqli_error($connect));
 if(isset($_GET['element'])){
	  $id=$_GET['element'];
	 $query="SELECT * from $ht where Id=$id";
	 $result=mysqli_query($connect,$query)or die(mysqli_error($connect));
	 $row=mysqli_fetch_row($result)or die(mysqli_error($connect));
	 if($row[1]===$usuario){
	 	$sql="DELETE FROM $ht WHERE Id=$id";
	 	if(mysqli_query($connect,$sql)){
	 	  //echo "se borro en tablea";	
	 	  $file=$row[4];
	 	  $b=unlink('../'.$file);
	 	  if($b){
	 	    echo "1";
	 	  }
	 	}
	 }else{
	 	echo "0";
	 }
	 	//echo "borrado $id";
}
 if(isset($_GET['edit'])){
     if(isset($_POST['id']) && !empty(trim($_POST['id']))){
         $idE=$_POST['id'];
         if(isset($_POST['title']) && !empty(trim($_POST['title']))){
             $title=$_POST['title'];
             $titleCod=base64_encode($_POST['title']);
            $query2 = "select * from $ht where Id=".$idE;
            $resulT = mysqli_query($connect, $query2);
            if(mysqli_num_rows($resulT)>0){
               $row = mysqli_fetch_row($resulT);
               $oldName=base64_decode($row[2]);
               $oldName=str_replace(" ","-",$oldName);
               $imgName="../".$row[4];
               $newName=str_replace(" ","-",$title);
               if(is_file($imgName)){
                 if(rename($imgName,str_replace($oldName,$newName,$imgName))){
                     $imgNameNew=str_replace($oldName,$newName,$imgName);
                     $queryT="UPDATE $ht SET Titulo='$titleCod', Img='".str_replace("../","",$imgNameNew)."' WHERE Id=$idE";
                    $result=mysqli_query($connect,$queryT);
	                if($result){
                        echo " se modifico el titulo de esta historia";
	                }else{
	                    echo mysqli_connect($connect);
	                }
                     //echo "\n se renombro la imagen";
                 }else{
                     echo " \n error al modificar datos de la imagen";
                 }
               }else{
                   echo "\n no existe la imagen";
               }
            }
         }
         //arreglar respuesta 
         if( isset($_POST['history']) && !empty($_POST['history']) ){
             $history=base64_encode($_POST['history']);
             $queryH="UPDATE $ht SET Contenido='$history' WHERE Id=$idE";
	         $result2=mysqli_query($connect,$queryH);
	         if($result2){
                echo "<br>se modifico el contenido de esta historia";
	         }else{
	             echo mysqli_error($connect);
	             //echo "<br>Error al modificar contenido de esta historia.";
	         }
         }
     }else{
         echo "define un id";
     }
 }
}else{
	header('location://guilleweb.cf/webApp/');
}
?>