<?php

namespace oblegation\vessel\http\client;

interface PostClient
{
    public function postPara(string $varName):mixed;
}