<?php

namespace oblegation\vessel\http\client;

interface RequestClient
{
    public function getRequestMethod():string;

    public function getURL():string;

    public function getRemoteHost():string;
}