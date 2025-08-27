    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="tools/main.css">
    <link rel="stylesheet" type="text/css" href="../icomoon/style.css">
    <script type="text/javascript" src="../../jquery.min.js"></script>
    <script type="text/javascript" src="tools/main.js"></script>
<?php
if(isset($_COOKIE['ing']) && !empty($_COOKIE['ing'])){
    if(isset($_COOKIE['user']) && !empty($_COOKIE['user'])){
        $host="sql305.infinityfree.com";
        $user="if0_39766672";
        $pass="Guilleweb042";
        $DB="if0_39766672_webAppUsers";
        $tabla="usuarios";
        $usuario=str_replace("_"," ",$_COOKIE['user']);
        $connect=mysqli_connect($host,$user,$pass);
        $db=mysqli_select_db($connect,$DB);
        if($connect){
            if($db){
                $query = "select * from $tabla";
                    if($resultado =mysqli_query($connect,$query)){
                        while($registro = mysqli_fetch_row($resultado)){ 
                    if($registro[1]===$usuario) {
                        $neim=$registro[1];
                        $nick=str_replace(" ","_",$neim);
                    }
                 }
              }
            }
        }
    }
}
?>
