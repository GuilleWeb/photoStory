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
 $tabla="usuarios";
 $connect=mysqli_connect($host,$user,$pass);
 $db=mysqli_select_db($connect,$DB);
	if(isset($_GET['friends'])){
		echo "Aqui podras ver a las personas que sigues, y las que te siguen.";
	}
	if(isset($_GET['follow']) && isset($_GET['myID'])){
	 $UID=$_GET['follow'];
	 $MID=$_GET['myID'];
	 $query="select * from $tabla WHERE Id=$MID";
	 $followCount=mysqli_query($connect,$query)or die(mysqli_error($connect));
     $Follow=mysqli_fetch_row($followCount)or die(mysqli_error($connect));
     $read=explode(",",$Follow[8]);
     if(in_array($UID,$read)){
        $NF=str_replace($UID.",","",$Follow[8]);
        $sql="UPDATE $tabla SET Seguidos='$NF' WHERE Id=$MID";
        mysqli_query($connect,$sql)or die("2");
        echo "0";
     }else{
        $sql="UPDATE $tabla SET Seguidos='$Follow[8]$UID,' WHERE Id=$MID";
        mysqli_query($connect,$sql)or die("2");
        echo "1";
     }
	}
 }
}else{
    header("location://guilleweb.cf/webApp");
}
?>