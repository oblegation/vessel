<?php

namespace muyomu\vessel\http\client;

interface PostClient
{
    public function postPara(string $varName):mixed;
}