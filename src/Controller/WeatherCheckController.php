<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Ipstack\Ipstack;

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
class WeatherCheckController implements ContainerInjectableInterface
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
        

        $body = $this->di->session->get("weatherData");

        $data = [            
           "body" => $body["content"]["list"] ?? null,
           "lat" => $body["content"]["city"]["coord"]["lat"] ?? null,
           "lon" => $body["content"]["city"]["coord"]["lon"] ?? null,
        ];
        return $this->di->get("page")
            ->add("weather_check", $data)
            ->render(["title" => "Weather Check"]);        
    }
    
    public function weatherActionPost()
    {
        $accessKey = file_get_contents(__DIR__ . "/api.txt");
        $trimmedKey =  trim($accessKey);
        $ip = $this->di->get("request")->getPost("ip") ?? null;
        $lat = $this->di->get("request")->getPost("lat") ?? null;
        $lon = $this->di->get("request")->getPost("lon") ?? null;

        $service = $this->di->get("weatherservice");

        $data = [
            "content" => $service->getWeather($ip, $lat, $lon),
        ];
        $this->di->session->set("weatherData", $data);


        return $this->di->response->redirect("weather_check");
        // $stack = new Ipstack();
        // $body = $this->di->get("request")->getPost("ip");
        // $accessKey = file_get_contents(__DIR__ . "/api.txt");
        // $trimmedKey =  trim($accessKey);
        
        // $info = $stack->getIpInfo($body ?? "127.0.0.1", $trimmedKey);
        // $this->di->session->set("ip", $info);
        // $this->di->session->set("key", $accessKey);
        // return $this->di->response->redirect("weather_check");
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
