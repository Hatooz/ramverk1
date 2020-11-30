<?php

namespace Anax\Service;
use Anax\Ipstack\Ipstack;


/**
 * A plain service class with no dependencies.
 */
class WeatherService
{
    private $message = null;



    public function setMessage(string $message) : void
    {
        $this->message = $message;
    }



    public function useService() : string
    {
        return "This service loads a message from the config file.<br>&gt; '{$this->message}'";
    }

    public function getWeather($cIp, $cLat, $cLon)
    {
        $key_array = include(__DIR__ . '/../../config/api_keys.php');
        var_dump($key_array);
        $stack = new Ipstack();
        $lat = $cLat;
        $lon = $cLon;
        if (($cLat == null || $cLon == null) && $cIp != null) {
            $response = $stack->getIpInfo($cIp, $key_array["keys"]["ipstack"]);
            $lat = $response["latitude"];
            $lon = $response["longitude"];
        }
        
        $api_key = "9f4ea5c263ca3d8d37ddfce61b157300";
        
        $query = "https://api.openweathermap.org/data/2.5/forecast?lat=". $lat . "&lon=".  $lon . "&appid=" . $key_array["keys"]["weather"];
        if ($lat != null && $lon != null) {
            $res = file_get_contents($query);
        }
        
        $info = json_decode($res, true);
        if ($info == null) {
            $info = ["error" => "Ingen info hittades för angivna ip/koordinater"];
        }
        return $info;
    }
}
