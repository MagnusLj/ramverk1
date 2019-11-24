<?php

namespace Malm18\Vader;

class VaderHandler
{


    public function parenting()
    {
        return "I am your father";
    }




    public function checkCoordinates($theIP)
    {
        if (filter_var($theIP, FILTER_VALIDATE_IP)) {
            $coordinates = [];
            $url = 'http://api.ipstack.com/';
            $keys = require ANAX_INSTALL_PATH . "/config/keys.php";
            $api_key = $keys["ipstackKey"];
            $request_url = $url . $theIP . '?access_key=' . $api_key;
            $curl = curl_init($request_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, [
        //   'X-RapidAPI-Host: kvstore.p.rapidapi.com',
        //   'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxx',
        //   'Content-Type: application/json'
        // ]);
            $response = curl_exec($curl);
            $response2 = json_decode($response, true);
            curl_close($curl);

            $coordinates['latitude'] = strval($response2['latitude']);
            $coordinates['longitude'] = strval($response2['longitude']);
            // echo $response . PHP_EOL;
            return $coordinates;
            //
            // // echo $response . PHP_EOL;
            // return $response2;


        } else {
            $coordinates = [];
            // $response = array("type" => "not valid ip", "ip" => "", "latitude"=> "", "longitude"=> "",
            // "city" => "", "country_name" => "", "region_name" => "", "continent_name" => "", "location['country_code']" => "");
            // // $response2 = json_decode($response, true);
            // return $response;
            $url1 = 'https://nominatim.openstreetmap.org/?format=json&addressdetails=1&q=';

            // $keys = require ANAX_INSTALL_PATH . "/config/keys.php";
            // $this->ipstackKey = $keys["ipstackKey"];
            // $api_key = $this->ipstackKey;
            $request_url = $url1 . $theIP . '&format=json&limit=1&email=a@b.se';
            // $request_url = 'https://nominatim.openstreetmap.org/?format=json&addressdetails=1&q=bakery+in+berlin+wedding&format=json&limit=1&email=a@b.se';
            $curl = curl_init($request_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, [
        //   'X-RapidAPI-Host: kvstore.p.rapidapi.com',
        //   'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxx',
        //   'Content-Type: application/json'
        // ]);
            $response = curl_exec($curl);
            $response2 = json_decode($response, true);
            curl_close($curl);
            $coordinates['latitude'] = $response2[0]['lat'];
            $coordinates['longitude'] = $response2[0]['lon'];
            // echo $response . PHP_EOL;
            return $coordinates;
        }
    }




    public function checkWeather($latitude, $longitude)
    {

        $url1 = 'https://api.darksky.net/forecast/';

        $keys = require ANAX_INSTALL_PATH . "/config/keys.php";
        $api_key = $keys["darkskyKey"];
        $end_stuff = '?exclude=minutely,hourly,currently,alerts,flags&extend=daily&lang=sv&units=auto';
        $request_url = $url1 . $api_key . "/" . $latitude . "," . $longitude . $end_stuff;
        // $request_url = 'https://nominatim.openstreetmap.org/?format=json&addressdetails=1&q=bakery+in+berlin+wedding&format=json&limit=1&email=a@b.se';
        $curl = curl_init($request_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($curl, CURLOPT_HTTPHEADER, [
    //   'X-RapidAPI-Host: kvstore.p.rapidapi.com',
    //   'X-RapidAPI-Key: 7xxxxxxxxxxxxxxxxxxxxxxx',
    //   'Content-Type: application/json'
    // ]);
        $response = curl_exec($curl);
        $response2 = json_decode($response, true);
        curl_close($curl);
        // $coordinates['latitude'] = $response2[0]['lat'];
        // $coordinates['longitude'] = $response2[0]['lon'];
        // echo $response . PHP_EOL;
        return $response2;

        // $coordinates = "Latitud: " . $latitude . ", longitud: " . $longitude;
        // return $coordinates;
    }


    public function checkWeather2($weather)
    {
        $weather2 = [];
        $locale = 'sv-SE.utf8';
        setlocale(LC_TIME, $locale);
        $i=0;
        foreach ($weather['data'] as $day) {
            // array_push($weather2, $day['time']);
            $unix_timestamp = $day['time'];
            $datetime = date('Y-m-d l', $unix_timestamp);
            $datetime2 = strftime('%A %d %B', strtotime($datetime));

            // $unix_timestamp = $day['time'];
            // $datetime = date('Y-m-d l', $unix_timestamp);
            // $datetime2 = strftime('%A %d %B', strtotime($datetime));

            // $datetime2 = $datetime->format('d/m');
            // $weather2[$i] = (['day'] => [$day]);
            $weather2[$i]['time'] = $datetime2;
            $weather2[$i]['summary'] = $day['summary'];
            $weather2[$i]['temperatureMin'] = round($day['temperatureMin']);
            $weather2[$i]['temperatureMax'] = round($day['temperatureMax']);
            $weather2[$i]['precipProbability'] = 100 * ($day['precipProbability']);
            $weather2[$i]['precipType'] = $day['precipType'];
            $weather2[$i]['windSpeed'] = round($day['windSpeed']);
            $weather2[$i]['windBearing'] = $day['windBearing'];
            // array_push($weather2, $datetime2);
            $i=$i+1;
        }
        return $weather2;
    }

//     foreach($inputs['test']['order'] as $test){
//         echo $test;
//
// }

    // echo $yummy->toppings[2]->id

//     foreach($arr as $key => &$val){
//     $val['color'] = 'red';
// }

   //  $cars = array
   // (
   // array("Volvo",22,18),
   // array("BMW",15,13),
   // array("Saab",5,2),
   // array("Land Rover",17,15)
   // );


    // $unix_timestamp = $_POST['timestamp'];
    // $datetime = new DateTime("@$unix_timestamp");
    // // Display GMT datetime
    // echo $datetime->format('d-m-Y H:i:s');


    public function minLong($longitude)
    {

        $minLong = floatval($longitude)-0.6427;
        return $minLong;
    }

    public function maxLong($longitude)
    {

        $maxLong = floatval($longitude)+0.6427;
        return $maxLong;
    }

    public function minLat($latitude)
    {

        $minLat = (floatval($latitude)) - 0.260;
        return $minLat;
    }

    public function maxLat($latitude)
    {

        $maxLat = (floatval($latitude)) + 0.260;
        return $maxLat;
    }


    // public function mapLink($latitude, $longitude, $minLat, $maxLat, $minLong, $maxLong)
    // {
    //                 https://www.openstreetmap.org/export/embed.html?bbox=-6.8860333396912%2C53.093889465332%2C-5.6006333396912%2C53.613889465332&amp;layer=mapnik&amp;marker=53.353889465332%2-6.2433333396912
    //     // $link = "https://www.openstreetmap.org/export/embed.html?bbox=12.669982910156252%2C55.56592203025787%2C13.955383300781252%2C56.08506381314523&amp;layer=mapnik&amp;marker=55.82635894724891%2C13.31268310546875"
    //
    //     $link = "https://www.openstreetmap.org/export/embed.html?bbox=" . $minLong . "%2C" . $minLat . "%2C" . $maxLong . "%2C" . $maxLat . "&amp;layer=mapnik&amp;marker=" . $latitude . "%2C" . $longitude;
    //
    //     return $link;
    // }

    public function mapLink($latitude, $longitude, $minLat, $maxLat, $minLong, $maxLong)
    {
        if ($latitude) {
            $link = "https://www.openstreetmap.org/export/embed.html?bbox=" . $minLong . "%2C" . $minLat . "%2C" . $maxLong . "%2C" . $maxLat . "&amp;layer=mapnik&amp;marker=" . $latitude . "%2C" . $longitude;
        } else {
            $link = "https://www.openstreetmap.org/export/embed.html?bbox=-0.64%2C85%2C0.64%2C90&amp;layer=mapnik&amp;marker=87.5%2C0";
        }

        return $link;
    }

    public function largeMapLink($latitude, $longitude)
    {
        if ($latitude) {
            $link = "https://www.openstreetmap.org/?mlat=" . $latitude . "&amp;mlon=" . $longitude . "#map=10/" . $latitude . "/" . $longitude;
        // <a href="https://www.openstreetmap.org/?mlat=55.8264&amp;mlon=13.3127#map=10/55.8264/13.3127">
        } else {
            $link = "https://www.openstreetmap.org";
        }
        return $link;
    }


    public function checkOwnIP()
    {
        $remote_addr = isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR']:'127.0.0.1';
        return $remote_addr;
    }
}
