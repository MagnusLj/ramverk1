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
    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";
    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";
        $session = $this->di->session;
        $IPHandler = new IPHandler();
        $session->set("IPHandler", $IPHandler);
        // var_dump($IPHandler);
    }


    // /**
    //  * This is the index method action, it handles:
    //  * ANY METHOD mountpoint
    //  * ANY METHOD mountpoint/
    //  * ANY METHOD mountpoint/index
    //  *
    //  * @return string
    //  */
    // public function indexAction() : string
    // {
    //     // Deal with the action and return a response.
    //     return __METHOD__ . ", \$db is {$this->db} BUUUUU";
    // }



    /**
     * This sample method dumps the content of $di.
     * GET mountpoint/dump-app
     *
     * @return array
     */
    public function jsonActionGet() : array
    {
        // Deal with the action and return a response.
        $services = implode(", ", $this->di->getServices());
        $json = [
            "message" => __METHOD__ . "<p>\$di contains: $services",
            "di" => $this->di->getServices(),
        ];
        return [$json];
    }
    /**
     * Add the request method to the method name to limit what request methods
     * the handler supports.
     * GET mountpoint/info
     *
     * @return string
     */
    public function pageActionGet() : object
    {
        // Add content as a view and then render the page
        $page = $this->di->get("page");
        $data = [
            "content" => "HELLO!"
        ];
        $page->add("anax/v2/article/default", $data);

        // $page->add("anax/v2/article/default", $data, "sidebar-left");
        // $page->add("anax/v2/article/default", $data, "sidebar-right");
        // $page->add("anax/v2/article/default", $data, "flash");
        return $page->render();
    }

    public function indexActionGet() : object
    {
        $session = $this->di->session;
        $IPHandler = $session->get("IPHandler");
        // $session->set("ip1", "ip2");
        // var_dump($session);
        // Add content as a view and then render the page
        $page = $this->di->get("page");
        // $data = [
        //     "content" => "HELLO!"
        // ];
        $page->add("ipChecker/ipChecker");
        // $IPHandler->active();
        // $page->add("anax/v2/article/default", $data, "sidebar-left");
        // $page->add("anax/v2/article/default", $data, "sidebar-right");
        // $page->add("anax/v2/article/default", $data, "flash");
        return $page->render();
    }

    public function indexActionPost() : object
    {


        $session = $this->di->session;
        $IPHandler = $session->get("IPHandler");
        $request = $this->di->request;
        $response = $this->di->response;
        if ($request->getPost("ipsubmit")) {
        $theIP = $request->getPost("ip1");
        $IPInfo = $IPHandler->checkIP($theIP);
        $session->set("ip1", $IPInfo['ipaddress']);
        $session->set("hostname", $IPInfo['hostname']);
        $session->set("type", $IPInfo['type']);

        return $response->redirect("ip-checker/resultpage");
    // } elseif ($_POST["newRoll"] ?? false) {
    }
        // $session->set("ip1", "ip2");
        // var_dump($session);
        // // Add content as a view and then render the page
        // $page = $this->di->get("page");
        // // $data = [
        // //     "content" => "HELLO!"
        // // ];
        // $page->add("ipChecker/ipChecker");
        // // $page->add("anax/v2/article/default", $data, "sidebar-left");
        // // $page->add("anax/v2/article/default", $data, "sidebar-right");
        // // $page->add("anax/v2/article/default", $data, "flash");
        // return $page->render();
    }

    public function resultPageActionGet() : object
    {
        $session = $this->di->session;
        // $session->set("ip1", "ip2");
        $ip1 = $session->get("ip1");
        $hostname = $session->get("hostname");
        $type = $session->get("type");
        // var_dump($session);
        $data = [
            "ip1" => $ip1,
            "hostname" => $hostname,
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
