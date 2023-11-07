<?php

namespace muyomu\vessel\ioc;

use muyomu\vessel\ContainerCore;
use muyomu\vessel\ioc\interface\ProxyClient;
use muyomu\vessel\utility\ReflectionTypeStrategy;
use ReflectionException;

class ProxyExecutor implements ProxyClient
{
    private ReflectionTypeStrategy $reflectionTypeStrategy;


    public function __construct(ContainerCore $vessel)
    {
        $this->reflectionTypeStrategy = new ReflectionTypeStrategy($vessel);
    }

    /**
     * @throws ReflectionException
     */
    public function getProxyInstance(mixed $classOrInstance): object
    {
        //获取参数类型
        $type = gettype($classOrInstance);

        //设置策略状态
        $this->reflectionTypeStrategy->setStatus($type);

        //执行策略
        return $this->reflectionTypeStrategy->getInstance($classOrInstance);
    }
}