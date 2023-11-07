<?php

namespace muyomu\vessel\ioc\interface;

interface ProxyClient
{
    public function getProxyInstance(mixed $classOrInstance):object;
}