<?php

namespace muyomu\vessel\http\client;

interface GetClient
{
    public function getPara(string $varName):mixed;
}