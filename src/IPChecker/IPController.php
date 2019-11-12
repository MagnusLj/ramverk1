<?php
namespace Malm18\IPChecker;

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
class IPController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet() : object
    {
        $session = $this->di->session;
        $IPHandler = new IPHandler();

        $ownIP = $IPHandler->checkOwnIP();

        echo $ownIP;

        $data = [
            "ownIP" => $ownIP
        ];

        // Add content as a view and then render the page
        $page = $this->di->get("page");

        $page->add("ipChecker/ipChecker", $data);

        return $page->render();
    }



    public function indexActionPost() : object
    {
        $session = $this->di->session;
        $IPHandler = new IPHandler();
        $request = $this->di->request;
        $response = $this->di->response;
        $theIP = $request->getPost("ip1");

        if (!is_null($theIP)) {
            $IPInfo = $IPHandler->checkIP($theIP);
            // $IPInfo2 = json_decode($IPInfo, true);
            // $IPInfo3 = gettype($IPInfo);
            // echo $IPInfo3;
            // var_dump(json_decode($IPInfo, true));
            // var_dump($IPInfo2);
            // var_dump($IPInfo['ip']);
            $session->set("ip1", $IPInfo['ip']);
            // $session->set("hostname", $IPInfo['hostname']);
            $session->set("type", $IPInfo['type']);
            $session->set("latitude", $IPInfo['latitude']);
            $session->set("longitude", $IPInfo['longitude']);
            $session->set("city", $IPInfo['city']);
            $session->set("country_name", $IPInfo['country_name']);
        }

           return $response->redirect("ip-checker/resultpage");
    }



    public function resultPageActionGet() : object
    {

        // $session->set("latitude", $IPInfo['latitude']);
        // $session->set("longitude", $IPInfo['longitude']);
        // $session->set("city", $IPInfo['city']);
        // $session->set("country_name", $IPInfo['country_name']);

        $session = $this->di->session;
        // $session->set("ip1", "ip2");
        $ip1 = $session->get("ip1");
        // $hostname = $session->get("hostname");
        $city = $session->get("city");
        $country_name = $session->get("country_name");
        $latitude = $session->get("latitude");
        $longitude = $session->get("longitude");
        $type = $session->get("type");

        // var_dump($session);
        $data = [
            "ip1" => $ip1,
            "city" => $city,
            "country_name" => $country_name,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "type" => $type
        ];
        // Add content as a view and then render the page
        $page = $this->di->get("page");
        // $data = [
        //     "content" => "HELLO!"
        // ];
        $page->add("ipChecker/resultPage", $data);
        // $page->add("anax/v2/article/default", $data, "sidebar-left");
        // $page->add("anax/v2/article/default", $data, "sidebar-right");
        // $page->add("anax/v2/article/default", $data, "flash");
        return $page->render();
    }
}
