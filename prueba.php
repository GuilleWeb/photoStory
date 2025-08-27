<?php
$content="Guillermo Palma https://guilleweb.cf www.google.com google.com";
$content= preg_replace("/((http|https|www)[^\s]+)/", '<a href="$1">$0</a>', $content);
$content= preg_replace("/href=\"www/", 'href="http://www', $content);
//echo '<h3>Cadena filtrada con enlaces normales:</h3>'.$content;
$pos = "guilleweb #hello";
$contento= preg_replace("/((#)[^\s]+)/", '<a onclick=string="$1";showMore("",string.replace("#","")); href="#">$0</a>', $pos);
//echo $contento;
/*if ($pos === false) {
    echo "<br>La cadena '$findme' no fue encontrada en la cadena '$mystring'";
} else {
    echo "<br>La cadena '$findme' fue encontrada en la cadena '$mystring'";
    echo " y existe en la posición $pos";
}*/
echo base64_encode("YPqzvLzywzqlErNq");
?>