<?php

namespace muyomu\vessel\config;

use muyomu\config\annotation\Configuration;
use muyomu\config\GenericConfig;

#[Configuration(VesselConfigClass::class)]
class VesselConfigClass extends GenericConfig
{
    protected string $configClass = self::class;

    protected array $configData = array(
        "port"=>9090,
        "count"=>3,
        "stdout"=>"../file/stdout.log",
        "status"=>"../file/status.log",
        "log"=>"../file/access.log",
        "error"=>"../error.log"
    );
}