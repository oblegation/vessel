<?php
namespace muyomu\vessel\framework;

use muyomu\vessel\http\Request;
use muyomu\vessel\http\Response;

abstract class BaseController
{
    protected Request $request;

    protected Response $response;
}