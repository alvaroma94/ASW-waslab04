var urinames = "city_names.php";
var uriinfo = "city_info.php";

function showCities () {
   var country = document.getElementById("countryName").value;

var req = new XMLHttpRequest();
   req.open("POST", urinames, true);
   req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	req.onreadystatechange = function() {
		if (req.readyState == 4 && req.status == 200) {
			var resp = req.responseText;
			var jresp = JSON.parse(resp);
			document.getElementById("left").innerHTML = resp;
			var ciutats = JSON.parse(resp);
			var html = "";
			for(i = 0; i < ciutats.Table.length; i++){
			      var ciutat = ciutats.Table[i].City;
			      html += '<p><a href="#" onClick=showWeather("'+ escape(ciutat) +'","'+country+'")>'+ciutat+"</a></p>";
			}
			document.getElementById("left").innerHTML = html;
		}
	};
	req.send("country=" + country);
};


function showWeather (ciutat, pais) {

  // Your implementation
	
	var req = new XMLHttpRequest();
	req.open("POST",uriinfo,true);
	req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	req.onreadystatechange = function() {
		if (req.readyState == 4 && req.status == 200) {
			var resp = req.responseText;
			var html="";
			if(resp == '"Data Not Found"'){
			    html = "No s'ha trobat informacio sobre aquesta ciutat";
			}
			else{
			  var info = JSON.parse(resp);
			  html += "Location: " + info.Location + "<br>" + "<br>";
			  html += "Time: " + info.Time + "<br>" + "<br>";
			  html += "Wind: " + info.Wind + "<br>" + "<br>";
			  html += "Visibility: " + info.Visibility + "<br>" + "<br>";
			  html += "SkyConditions: " + info.SkyConditions + "<br>" + "<br>";
			  html += "Temperature: " + info.Temperature + "<br>" + "<br>";
			  html += "DewPoint: " + info.DewPoint + "<br>" + "<br>";
			  html += "RelativeHumity: " + info.RelativeHumity + "<br>" + "<br>";
			  html += "Pressure: " + info.Pressure + "<br>" + "<br>";
 			  html += "Status: " + info.Status + "<br>" + "<br>";
			  
			}
			document.getElementById("right").innerHTML = html;
		}
	};
	req.send("CountryName=" + pais + "&CityName=" + ciutat);
   
}

window.onload = showCities();
