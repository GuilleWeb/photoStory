<?php
function myCode($encode,$decode){
	//abecedario minusculas
	$abc=[];
	for($car = 97; $car < 123; $car++) {
	array_push($abc,utf8_encode(chr($car)));
	}
	//simbolos
	$char=[];
	for($car = 35; $car < 39; $car++) {
	array_push($char,utf8_encode(chr($car)));
	}
	for($car = 40; $car < 48; $car++) {
	array_push($char,utf8_encode(chr($car)));
	}
	for($car = 63; $car < 65; $car++) {
	array_push($char,utf8_encode(chr($car)));
	}
	for($car = 91; $car < 97; $car++) {
	array_push($char,utf8_encode(chr($car)));
	}
	for($car = 123; $car < 127; $car++) {
	array_push($char,utf8_encode(chr($car)));
	}/*
	for($car = 155; $car < 159; $car++) {
	array_push($char,utf8_encode(chr($car)));
	}*/
	//codificar
	if(isset($encode) && !empty($encode)){
	//$cadE=base64_encode($encode);
	$cadE=$encode;
	for($x=0;$x<count($abc);$x++){
	$cadE=str_replace($abc[$x],$char[$x],$cadE);
	//echo $cadE."<br>";
	}
	



	//hacer algo para que no de error
	// con los caracteres no validos como simbolos
	



	return $cadE;
		}
	//decodificar
	if(isset($decode) && !empty($decode)){
	$cadC=$decode;
	for($x=0;$x<count($abc);$x++){
	$cadC=str_replace($char[$x],$abc[$x],$cadC);
	//echo $cadE."<br>";
	}
	//return base64_decode($cadC);
	return $cadC;

		}
}
?>