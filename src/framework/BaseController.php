<?php
namespace oblegation\vessel\framework;

use oblegation\vessel\http\Request;
use oblegation\vessel\http\Response;

abstract class BaseController
{
    protected Request $request;

    protected Response $response;
}