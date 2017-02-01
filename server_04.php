<?php
 
ini_set("soap.wsdl_cache_enabled","0");
$server = new SoapServer("http://localhost:8080/waslab04/WSLabService.wsdl");

function FahrenheitToCelsius($fdegree){
    $cresult = ($fdegree - 32) * (5/9);
    return array("cresult"=> $cresult, "timeStamp"=> date('c', time()) );
}

function CurrencyConverter($from_Currency,$to_Currency,$amount) {
	$uri = "http://currencies.apps.grandtrunk.net/getlatest/$from_Currency/$to_Currency";
	$rate = doubleval(file_get_contents($uri));
	return round($amount * $rate, 2);
};

function CurrencyConverterPlus($objecte) {
	
	$x = array();

	foreach ($objecte->to_Currencies as $cur){
		$y = CurrencyConverter($objecte->from_Currency,$cur,$objecte->amount);
		$z = new stdClass();
		$z->currency=$cur;
		$z->amount=$y;
		array_push($x, $z);
	}
	
	return $x;
};



// Task #4: Implement here the CurrencyConverterPlus function and add it to $server

$server->addFunction("FahrenheitToCelsius");
$server->addFunction("CurrencyConverterPlus");



// Task #3 -> Uncomment the following line:
 $server->addFunction("CurrencyConverter");

$server->handle();
 
?>
