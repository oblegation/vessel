<?php

namespace oblegation\vessel\http;

use oblegation\vessel\http\client\GetClient;
use oblegation\vessel\http\client\HeaderClient;
use oblegation\vessel\http\client\PostClient;
use oblegation\vessel\http\client\RequestClient;

class Request implements RequestClient,GetClient,PostClient,HeaderClient
{
    private \Workerman\Protocols\Http\Request $request;

    public function __construct(\Workerman\Protocols\Http\Request $request)
    {

        $this->request = $request;
    }

    /*
     * http method ==========================================
     */

    /**
     * @return string
     */
    public function getRequestMethod():string{
        return $this->request->method();
    }

    /**
     * @return string
     */
    public function getRemoteHost():string{
        return $this->request->host();
    }

    /**
     * @return string
     */
    public function getURL(): string
    {
        return $this->getURL();
    }

    /*
     * parameter---------------------------------------------------------
     */

    /**
     * @param string $varName
     * @return mixed
     */
    public function getPara(string $varName): mixed
    {
        return $this->request->get($varName);
    }

    /**
     * @param string $varName
     * @return mixed
     */
    public function postPara(string $varName): mixed
    {
        return $this->request->post($varName);
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getHeader(string $key):string |null{
        return $this->request->header($key);
    }
}