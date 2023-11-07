<?php

namespace oblegation\vessel\ioc;

use oblegation\vessel\ContainerCore;
use oblegation\vessel\ioc\interface\ProxyClient;
use oblegation\vessel\utility\ReflectionTypeStrategy;
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