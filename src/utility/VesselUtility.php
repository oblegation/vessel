<?php

namespace muyomu\vessel\utility;

use Exception;
use muyomu\log4p\Log4p;
use muyomu\vessel\Vessel;
use ReflectionClass;

class VesselUtility extends Vessel
{
    /**
     * @throws Exception
     */
    public static function  runVessel(string $uri, Log4p $log4p):mixed{

        if (array_key_exists($uri,Vessel::$webRoute)){

            $controller = Vessel::$test->getContainer(Vessel::$webRoute[$uri]["controller"]);

            $kk = new ReflectionClass($controller);

            $kk->getProperty("request")->setValue($controller,Vessel::$test->getContainer("request"));

            $kk->getProperty("response")->setValue($controller,Vessel::$test->getContainer("response"));

            $method = $kk->getMethod(Vessel::$webRoute[$uri]["method"]);

            return  $method->invokeArgs($controller,array());

        }else{
            $log4p->muix_log_info("error","Url is not registered!");
            return null;
        }
    }
}