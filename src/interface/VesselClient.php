<?php

namespace muyomu\vessel\interface;

interface VesselClient
{
    public function getContainer(string $containerId):object;

    public function registerContainer(string $containerId, array $document):void;

    public function init(string $containerId):void;
}