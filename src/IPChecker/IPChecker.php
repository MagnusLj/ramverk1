<?php

namespace Anax\Controller;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IPController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        return "Indexx";
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function initAction() : object
    {
        // Init session for game start

        $session = $this->app->session;
        $response = $this->app->response;

        $computer = new Pig();
        $computer->setName("Datorn");


        $human = new Pig();
        $human->setName("Människan");

        // $histogram = new Histogram();


        $pigHandler = new PigHandler();


        $session->set("computer", $computer);
        $session->set("human", $human);
        $session->set("pigHandler", $pigHandler);


        return $response->redirect("pig1/play");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionGet() : object
    {


        $session = $this->app->session;
        // $response = $this->app->response;
        $page = $this->app->page;

        $title = "Spela kasta gris (Controller)";

        $computer = $session->get("computer");
        $human = $session->get("human");
        $pigHandler = $session->get("pigHandler");


        $cValue = $computer->value();
        $cName = $computer->getName();
        $hValue = $human->value();
        $hName = $human->getName();
        $active = $pigHandler->active($computer, $human);


        $session->set("computer", $computer);
        $session->set("human", $human);
        $session->set("pigHandler", $pigHandler);


        $data = [
            "cName" => $cName,
            "hName" => $hName,
            "cValue" => $cValue,
            "hValue" => $hValue,
            "active" => $active
            // "result" => $result ?? null
        ];

        // $pigHandler->computerRoll($computer);

        $page->add("pig1/play", $data);
        // $this->app->page->add("pig1/debug");

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionPost() //: object
    {
        // $session = $this->app->session;
        $response = $this->app->response;

        // $computer = $session->get("computer");
        // $human = $session->get("human");
        // $pigHandler = $session->get("pigHandler");


        return $response->redirect("pig1/play2");
    }








    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function play2ActionGet() //: object
    {
        $title = "Kasta gris";

        $session = $this->app->session;
        $response = $this->app->response;
        $page = $this->app->page;


        $computer = $session->get("computer");
        $human = $session->get("human");
        $pigHandler = $session->get("pigHandler");

        // print_r($human->hArray);
        // print_r($computer->hArray);

        // $dice = new DiceHistogram2();


        $histogramH = new Histogram();
        $histogramC = new Histogram();
        $histogramH->injectData($human);
        $histogramC->injectData($computer);


        $active = $pigHandler->getActive($computer, $human);

        $pigHandler->computerRoll($computer, $human);

        $die1H = $human->getDie1();
        $die2H = $human->getDie2();

        $die1C = $computer->getDie1();
        $die2C = $computer->getDie2();

        $rollsH = $human->getRolls();
        $rollsC = $computer->getRolls();

        $turnScoreH = $human->getTurnScore();
        $turnScoreC = $computer->getTurnScore();

        $totalScoreH = $human->getTotalScore();
        $totalScoreC = $computer->getTotalScore();

        $diceSumH = $human->getDiceSum();
        $diceSumC = $computer->getDiceSum();

        $rollsH = $human->getRolls();
        $rollsC = $computer->getRolls();

        $bottom = $pigHandler->getActive2($computer, $human);

        $winner = $pigHandler->isWinner2($human, $computer);


        $data = [
            "active" => $active,
            "die1H" => $die1H,
            "die2H" => $die2H,
            "die1C" => $die1C,
            "die2C" => $die2C,
            "rollsH" => $rollsH,
            "rollsC" => $rollsC,
            "turnScoreH" => $turnScoreH,
            "turnScoreC" => $turnScoreC,
            "totalScoreH" => $totalScoreH,
            "totalScoreC" => $totalScoreC,
            "diceSumH" => $diceSumH,
            "diceSumC" => $diceSumC,
            "winner" => $winner,
            "histogramH" => $histogramH,
            "histogramC" => $histogramC
        ];



        if ($totalScoreH >= 100) {
            return $response->redirect("pig1/gameOver");
        } elseif ($totalScoreC >= 100) {
            return $response->redirect("pig1/gameOver");
        } else {
            $page->add("pig1/play2", $data);

            $page->add($bottom);


            return $page->render([
                "title" => $title,
            ]);
        }
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function play2ActionPost() : object
    {
        /**
         * Redirect after computer throw.
         */

         $session = $this->app->session;
         $response = $this->app->response;
         $request = $this->app->request;

         $computer = $session->get("computer");
         $human = $session->get("human");
         $pigHandler = $session->get("pigHandler");

        // if ($_POST["continue2"] ?? false) {
        if ($request->getPost("continue2")) {
            $pigHandler->mainRoll($human, $computer);


            $session->set("computer", $computer);
            $session->set("human", $human);
            $session->set("pigHandler", $pigHandler);

            return $response->redirect("pig1/play2");
        // } elseif ($_POST["newRoll"] ?? false) {
        } elseif ($request->getPost("newRoll")) {
            $pigHandler->mainRoll2($human, $computer);

            $session->set("computer", $computer);
            $session->set("human", $human);
            $session->set("pigHandler", $pigHandler);

            return $response->redirect("pig1/play2");
        // } elseif ($_POST["stop"] ?? false) {
        } elseif ($request->getPost("stop")) {
            $pigHandler->mainRoll($human, $computer);

            $session->set("computer", $computer);
            $session->set("human", $human);
            $session->set("pigHandler", $pigHandler);

            return $response->redirect("pig1/play2");

        // } elseif ($_POST["continue3"] ?? false) {
        } elseif ($request->getPost("continue3")) {
            return $response->redirect("pig1/init");
        }
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function gameOverActionGet() : object
    {
        $session = $this->app->session;
        // $response = $this->app->response;
        $page = $this->app->page;

        $title = "Kasta gris";

        $computer = $session->get("computer");
        $human = $session->get("human");
        $pigHandler = $session->get("pigHandler");

        $winner = $pigHandler->isWinner2($human, $computer);

        $data = [
            "winner" => $winner
        ];

        $page->add("pig1/gameOver", $data);

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function gameOverActionPost() : object
    {
        $response = $this->app->response;
        return $response->redirect("pig1/init");
    }






    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        return "Debug my pig";
    }
}

//     /**
//      * This sample method dumps the content of $app.
//      * GET mountpoint/dump-app
//      *
//      * @return string
//      */
//     public function dumpAppActionGet() : string
//     {
//         // Deal with the action and return a response.
//         $services = implode(", ", $this->app->getServices());
//         return __METHOD__ . "<p>\$app contains: $services";
//     }
//
//
//
//     /**
//      * Add the request method to the method name to limit what request methods
//      * the handler supports.
//      * GET mountpoint/info
//      *
//      * @return string
//      */
//     public function infoActionGet() : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}";
//     }
//
//
//
//     /**
//      * This sample method action it the handler for route:
//      * GET mountpoint/create
//      *
//      * @return string
//      */
//     public function createActionGet() : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}";
//     }
//
//
//
//     /**
//      * This sample method action it the handler for route:
//      * POST mountpoint/create
//      *
//      * @return string
//      */
//     public function createActionPost() : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}";
//     }
//
//
//
//     /**
//      * This sample method action takes one argument:
//      * GET mountpoint/argument/<value>
//      *
//      * @param mixed $value
//      *
//      * @return string
//      */
//     public function argumentActionGet($value) : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}, got argument '$value'";
//     }
//
//
//
//     /**
//      * This sample method action takes zero or one argument and you can use - as a separator which will then be removed:
//      * GET mountpoint/defaultargument/
//      * GET mountpoint/defaultargument/<value>
//      * GET mountpoint/default-argument/
//      * GET mountpoint/default-argument/<value>
//      *
//      * @param mixed $value with a default string.
//      *
//      * @return string
//      */
//     public function defaultArgumentActionGet($value = "default") : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}, got argument '$value'";
//     }
//
//
//
//     /**
//      * This sample method action takes two typed arguments:
//      * GET mountpoint/typed-argument/<string>/<int>
//      *
//      * NOTE. Its recommended to not use int as type since it will still
//      * accept numbers such as 2hundred givving a PHP NOTICE. So, its better to
//      * deal with type check within the action method and throuw exceptions
//      * when the expected type is not met.
//      *
//      * @param mixed $value with a default string.
//      *
//      * @return string
//      */
//     public function typedArgumentActionGet(string $str, int $int) : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}, got string argument '$str' and int argument '$int'.";
//     }
//
//
//
//     /**
//      * This sample method action takes a variadic list of arguments:
//      * GET mountpoint/variadic/
//      * GET mountpoint/variadic/<value>
//      * GET mountpoint/variadic/<value>/<value>
//      * GET mountpoint/variadic/<value>/<value>/<value>
//      * etc.
//      *
//      * @param array $value as a variadic parameter.
//      *
//      * @return string
//      */
//     public function variadicActionGet(...$value) : string
//     {
//         // Deal with the action and return a response.
//         return __METHOD__ . ", \$db is {$this->db}, got '" . count($value) . "' arguments: " . implode(", ", $value);
//     }
//
//
//
//     /**
//      * Adding an optional catchAll() method will catch all actions sent to the
//      * router. You can then reply with an actual response or return void to
//      * allow for the router to move on to next handler.
//      * A catchAll() handles the following, if a specific action method is not
//      * created:
//      * ANY METHOD mountpoint/**
//      *
//      * @param array $args as a variadic parameter.
//      *
//      * @return mixed
//      *
//      * @SuppressWarnings(PHPMD.UnusedFormalParameter)
//      */
//     public function catchAll(...$args)
//     {
//         // Deal with the request and send an actual response, or not.
//         //return __METHOD__ . ", \$db is {$this->db}, got '" . count($args) . "' arguments: " . implode(", ", $args);
//         return;
//     }
// }
