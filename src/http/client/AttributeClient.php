<?php

namespace muyomu\vessel\http\client;

interface AttributeClient
{
    public function setAttribute(string $key,mixed $value):bool;

    public function getAttribute(string $key):mixed;
}