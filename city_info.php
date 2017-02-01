<?php
ini_set("soap.wsdl_cache_enabled","0");

try{

  $sClient = new SoapClient('http://www.webservicex.net/globalweather.asmx?WSDL');

  // Get the necessary parameters from the request
  // Use $sClient to call the operation GetWeather
  // echo the returned info as a JSON object
  $country=$_POST['CountryName'];
  $city=$_POST['CityName'];

    $cname = new stdClass();
    $cname->CityName = $city;
    $cname->CountryName = $country;
    $res = $sClient->GetWeather($cname);

    $response = $res->GetWeatherResult;
    if($response != "Data Not Found"){
      $replaceutf = str_replace('<?xml version="1.0" encoding="utf-16"?>',' ',$response);
      $response = new SimpleXMLElement($replaceutf);
    }
    echo json_encode($response);

  /*header(':', true, 501); // Just remove this line to return the successful 
                          // HTTP-response status code 200.
  echo json_encode(array('Result' => 'Not implemented'));
  */
}
catch(SoapFault $e){
  header(':', true, 500);
  echo json_encode($e);
}
?>
