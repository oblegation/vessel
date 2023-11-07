<?php

namespace oblegation\vessel;

use Exception;
use oblegation\vessel\interface\VesselClient;
use oblegation\vessel\ioc\ProxyExecutor;
use ReflectionException;
use ReflectionFunction;

class ContainerCore implements VesselClient
{
    private array $baseConfig;

    public array $vessel;

    private ProxyExecutor $proxyExecutor;

    /**
     * @param array $baseConfig
     */
    public function __construct(array $baseConfig){

        $this->baseConfig = $baseConfig;

        $this->vessel = array();

        $this->proxyExecutor = new ProxyExecutor($this);
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function init(string $containerId): void
    {
        $document = $this->baseConfig[$containerId];

        $builder = new ReflectionFunction($document["builder"]);

        $parameters = $builder->getParameters();

        $args = array();

        foreach ($parameters as $parameter){

            $id = $parameter->getName();

            if (array_key_exists($id,$this->vessel)){

                $args[$id] = $this->vessel[$id];

            }elseif (array_key_exists($id,$this->baseConfig)){

                $this->init($id);

                if (array_key_exists($id,$this->vessel)){

                    $args[$id] = $this->vessel[$id];

                }else{
                    throw new Exception("k");
                }
            }else{
                throw new Exception("k");
            }
        }

        $container = $builder->invokeArgs($args);

        $this->proxyExecutor->getProxyInstance($container);

        $this->vessel[$containerId] = $container;
    }

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function registerContainer(string $containerId, array $document): void
    {
        if (!array_key_exists($containerId, $this->vessel)){

            $this->baseConfig[$containerId] = $document;

        }else{
            throw new Exception("no");
        }
    }

    /**
     * @throws Exception
     */
    public function getContainer(string $containerId):object
    {
        if (array_key_exists($containerId, $this->vessel)){

            return $this->vessel[$containerId];

        }elseif (array_key_exists($containerId, $this->baseConfig)){

            $this->init($containerId);

            if (array_key_exists($containerId, $this->vessel)){

                return $this->vessel[$containerId];

            }else{
                throw new Exception("no");
            }
        }else{
            throw new Exception("no");
        }
    }

    /**
     * @param array $configArray
     * @return void
     * @throws ReflectionException
     */
    public function registerVessel(array $configArray = array()):void{

        foreach ($configArray as $item => $value){

            $this->registerContainer($item, $value);
        }
    }
}