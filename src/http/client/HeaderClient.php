<?php

namespace muyomu\vessel\http\client;

interface HeaderClient
{
    public function getHeader(string $key):string | null;
}