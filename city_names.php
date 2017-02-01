<?php
ini_set("soap.wsdl_cache_enabled","0");

try{
	

	$sClient = new SoapClient('http://www.webservicex.net/globalweather.asmx?WSDL');
  
  
    // Get the necessary parameters from the request
    // Use $sClient to call the operation GetCitiesByCountry
    // echo the returned info as a JSON array of strings (city names)
    
	$country=$_POST['country'];
	$cname = new stdClass();
	$cname->CountryName = $country;
	$res = $sClient->GetCitiesByCountry($cname);
	$resJSON = new SimpleXMLElement($res->GetCitiesByCountryResult);
	echo json_encode($resJSON);

    /*header(':', true, 501); // Just remove this line to return the successful 
                          // HTTP-response status code 200.
    echo '["Not","Yet","Implemented"]';
	*/
}
catch(SoapFault $e){
  header(':', true, 500);
  echo json_encode($e);
}

