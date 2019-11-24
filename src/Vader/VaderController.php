<?php
namespace Malm18\Vader;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;
/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class VaderController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet() : object
    {
        $vader = $this->di->get("vader");
        // $session = $this->di->session;

        $ownIP = $vader->checkOwnIP();



        $data = [
            "ownIP" => $ownIP
        ];
        // $parenting = $this->di->vader;
        $parenting = $vader->parenting();
        echo $parenting;
        // Add content as a view and then render the page
        $page = $this->di->get("page");

        $page->add("vader/vader", $data);

        return $page->render();
    }



    public function indexActionPost() : object
    {
        $session = $this->di->session;
        $vader = $this->di->get("vader");
        // $IPHandler = new IPHandler();
        $request = $this->di->request;
        $response = $this->di->response;
        $theIP = $request->getPost("ip1");

        if (!is_null($theIP)) {
            // $IPInfo = $IPHandler->checkIP($theIP);
            // $IPInfo2 = json_decode($IPInfo, true);
            // $IPInfo3 = gettype($IPInfo);
            // echo $IPInfo3;
            // var_dump(json_decode($IPInfo, true));
            // var_dump($IPInfo2);
            // var_dump($IPInfo['ip']);
            $session->set("ip1", $theIP);
            // $session->set("hostname", $IPInfo['hostname']);
            // $session->set("type", $IPInfo['type']);
            // $session->set("latitude", $IPInfo['latitude']);
            // $session->set("longitude", $IPInfo['longitude']);
            // $session->set("city", $IPInfo['city']);
            // $session->set("country_name", $IPInfo['country_name']);
            // var_dump($session);
        }
           return $response->redirect("vader/resultpage");
    }



    public function resultPageActionGet() : object
    {

        // $session->set("latitude", $IPInfo['latitude']);
        // $session->set("longitude", $IPInfo['longitude']);
        // $session->set("city", $IPInfo['city']);
        // $session->set("country_name", $IPInfo['country_name']);

        $session = $this->di->session;

        $theIP = $session->get("ip1");

        var_dump($theIP);

        // $vader = $this->di->get("vader");
        // $IPHandler = new IPHandler();

        $vader = $this->di->get("vader");

        $coordinates = $vader->checkCoordinates($theIP);

        $weather = $vader->checkWeather($coordinates['latitude'], $coordinates['longitude']);

        // $latitude = $IPInfo['latitude'];
        // $longitude = $IPInfo['longitude'];
        // $minLong = $vader->minLong($IPInfo['longitude']);
        // $maxLong = $vader->maxLong($IPInfo['longitude']);
        // $minLat = $vader->minLat($IPInfo['latitude']);
        // $maxLat = $vader->maxLat($IPInfo['latitude']);
        // $mapLink = $vader->mapLink($latitude, $longitude, $minLat, $maxLat, $minLong, $maxLong);

        // $var = 5;
        // $var_is_greater_than_two = ($var > 2 ? true : false);

        var_dump($coordinates);

        // var_dump($weather['daily']);

        $weather2 = $vader->checkWeather2($weather['daily']);

        var_dump($weather2);
        // $session->set("ip1", "ip2");

        // $hostname = $session->get("hostname");
        // $city = $session->get("city");
        // $country_name = $session->get("country_name");
        // $latitude = $session->get("latitude");
        // $longitude = $session->get("longitude");
        // $type = $session->get("type");

        // var_dump($session);



        // $data = [
        //     "ip1" => $theIP,
        //     "city" => $IPInfo['city'],
        //     "country_name" => $IPInfo['country_name'],
        //     "latitude" => $IPInfo['latitude'],
        //     "longitude" => $IPInfo['longitude'],
        //     "mapLink" => $mapLink,
        //     "continent_name" => $IPInfo['continent_name'],
        //     "region_name" => $IPInfo['region_name'],
        //     "type" => $IPInfo['type']
        // ];

        $data = [
            "weather2" => $weather2,
            "theIP" => $theIP
        ]
            ;

        // Add content as a view and then render the page
        $page = $this->di->get("page");
        // $data = [
        //     "content" => "HELLO!"
        // ];
        $page->add("vader/resultPage", $data);
        // $page->add("anax/v2/article/default", $data, "sidebar-left");
        // $page->add("anax/v2/article/default", $data, "sidebar-right");
        // $page->add("anax/v2/article/default", $data, "flash");
        return $page->render();
    }
}
