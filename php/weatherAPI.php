<?php
 $curl= curl_init();

 $endpoint="http://dataservice.accuweather.com/forecasts/v1/daily/1day/215605?apikey=p5AxU4toCpJdddO3MDpbHT2CxGwq0XQd&language=it&details=true";

 curl_setopt($curl,CURLOPT_URL,$endpoint);
 curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

 $res=curl_exec($curl);
 echo $res;
 curl_close($curl);
?>