<?php

namespace muyomu\vessel;

use muyomu\log4p\Log4p;
use muyomu\vessel\config\VesselConfigClass;
use muyomu\vessel\http\Response;
use muyomu\vessel\utility\VesselUtility;
use Throwable;
use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Worker;

class Vessel
{
    private static VesselConfigClass $configClass;

    private static Log4p $log4p;

    private static VesselUtility $vesselUtility;

    protected static ContainerCore $test;

    protected static array $webRoute;

    private static array $configArray;

    /**
     * @param array $router
     * @return void
     */
    public static function registerWebRoute(array $router = array()):void{
        Vessel::$webRoute = $router;
    }

    /**
     * @param array $configArray
     * @return void
     */
    public static function registerVessel(array $configArray = array()):void{
        Vessel::$configArray = $configArray;
    }

    /**
     * @return void
     */
    public static function run():void{
        //获取配置类
        Vessel::$configClass = new VesselConfigClass();

        Vessel::$log4p = new Log4p();

        Vessel::$vesselUtility = new VesselUtility();

        //worker
        $service = new Worker("http://0.0.0.0:9090");

        //配置属性
        $service->count = Vessel::$configClass->getOptions("count");

        $service::$stdoutFile = Vessel::$configClass->getOptions("stdout");

        $service::$statusFile = Vessel::$configClass->getOptions("status");

        $service::$logFile = Vessel::$configClass->getOptions("log");

        $service->reloadable = true;

        //配置事件
        $service->onWorkerStart = function (Worker $worker){

            Vessel::$test = new ContainerCore(array());

            Vessel::$test->registerVessel(Vessel::$configArray);
        };

        $service->onConnect = function (TcpConnection $connection){

        };

        $service->onMessage = function (TcpConnection $connection, Request $request){

            Vessel::$test->vessel["request"] = new http\Request($request);

            Vessel::$test->vessel["response"] = new Response($connection);

            $result = Vessel::$vesselUtility::runVessel($request->uri(),Vessel::$log4p);

            $connection->send($result);
        };

        $service->onClose = function (TcpConnection $connection){

        };

        $service->onWorkerReload = function (Worker $worker){

        };

        $service->onWorkerStop = function (Worker $worker){

        };

        try {
            Worker::runAll();
        } catch (Throwable $e) {
            Vessel::$log4p->muix_log_info("error",$e->getMessage());
        }
    }
}