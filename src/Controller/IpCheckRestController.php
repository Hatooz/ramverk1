<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample JSON controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 */
class IpCheckRestController implements ContainerInjectableInterface
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
    }



    /**
     * This is the index method action, it handles:
     * GET METHOD mountpoint
     * GET METHOD mountpoint/
     * GET METHOD mountpoint/index
     *
     * @return array
     */
    public function indexActionGet() : object
    {
        // Deal with the action and return a response.
        // $json = [
        //     "message" => __METHOD__ . ", \$db is {$this->db}",
        // ];
        // return [$json];

        $body = $this->di->session->get("ip_rest");
        

        $data = [
            "result" => $body["result"] ?? null,
            "domain" => $body["domain"] ?? null,
        ];

        $page = $this->di->get("page");
        $page->add(
            "ip_check_rest",
            $data
        );
        return $page->render();
    }

    /**
     * This is the index method action, it handles:
     * GET METHOD mountpoint
     * GET METHOD mountpoint/
     * GET METHOD mountpoint/index
     *
     * @return array
     */
    public function indexActionPost()
    {
       
        $doRest = $this->di->get("request")->getPost("doRest");
        if ($doRest) {
            $body = $this->di->get("request")->getPost("ip_rest");
            $postData = [
                "ip_rest" => $body
            ];
            $context = stream_context_create(array(
                'http' => array(
                    'method' => 'POST',
                    'header'  => "Content-Type: application/json\r\n",
                    'content' => json_encode($postData)
                )
            ));
            $response = file_get_contents("http://www.student.bth.se/~hami19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ip_check_rest", false, $context);
            header('Content-Type: application/json');
            return json_encode($response);
         
            die();
        }
      
        $body = $this->di->get("request")->getBodyAsJson();
        if(isset($body["ip_rest"])) {
            $validIp4 = filter_var($body["ip_rest"], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
            $validIp6 = filter_var($body["ip_rest"], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
        }
        
        if ($validIp4) {
            $data = [
                "result" => "IP address $validIp4 is a valid IPv4 IP.",
                "domain" => gethostbyaddr($body)
            ];
        } elseif ($validIp6) {
            $data = [
                "result" => "IP address $validIp6 is a valid IPv6 IP.",
                "domain" => gethostbyaddr($body)
            ];
        } else {
            $data = [
                "result" => "IP address is not a valid IP.",
                "domain" => null
            ];
        }

       
     
        $json = [
            "message" => __METHOD__ . ", POST",
            "header" => "Content-Type: application/json\r\n",
            "result" => $data["result"],
            "domain" => $data["domain"],
           
        ];
        return [$json];
    }



    /**
     * This sample method dumps the content of $di.
     * GET mountpoint/dump-app
     *
     * @return array
     */
    public function dumpDiActionGet() : array
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
     * Try to access a forbidden resource.
     * ANY mountpoint/forbidden
     *
     * @return array
     */
    public function forbiddenAction() : array
    {
        // Deal with the action and return a response.
        $json = [
            "message" => __METHOD__ . ", forbidden to access.",
        ];
        return [$json, 403];
    }
}
