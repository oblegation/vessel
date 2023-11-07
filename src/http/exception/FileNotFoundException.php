<?php

namespace muyomu\vessel\http\exception;

use Exception;

class FileNotFoundException extends Exception
{

    public function __construct()
    {
        parent::__construct("Your Request File don't exit");
    }
}