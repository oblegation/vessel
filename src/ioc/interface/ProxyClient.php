<?php

namespace oblegation\vessel\ioc\interface;

interface ProxyClient
{
    public function getProxyInstance(mixed $classOrInstance):object;
}