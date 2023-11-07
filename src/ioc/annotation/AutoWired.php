<?php

namespace muyomu\vessel\ioc\annotation;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class AutoWired
{
    public function __construct(){

    }
}