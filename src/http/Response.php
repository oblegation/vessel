<?php

namespace muyomu\vessel\http;

use Exception;
use muyomu\vessel\http\client\FormatClient;
use muyomu\vessel\http\client\HttpClient;
use muyomu\vessel\http\client\ResponseClient;
use muyomu\vessel\http\config\DefaultHttpConfig;
use muyomu\vessel\http\exception\FileNotFoundException;
use muyomu\vessel\http\format\ExceptionFormat;
use muyomu\vessel\http\utility\HeaderUtility;
use Workerman\Connection\TcpConnection;

class Response implements ResponseClient, HttpClient
{

    private DefaultHttpConfig $defaultHttpConfig;

    private HeaderUtility $headerUtility;

    private TcpConnection $connection;

    private \Workerman\Protocols\Http\Response $response;

    public function __construct(TcpConnection $connection)
    {
        $this->defaultHttpConfig = new DefaultHttpConfig();

        $this->headerUtility = new HeaderUtility();

        $this->connection = $connection;

        $this->response = new \Workerman\Protocols\Http\Response(200);
    }

    //response

    /**
     * @param string $fileName
     * @param bool $display
     * @return void
     * @throws FileNotFoundException
     */
    public function doPlainResponse(string $fileName, bool $display = true): void
    {
        //生成响应类
        $this->response->withHeaders($this->defaultHttpConfig->getOptions("headers"));

        //设置专用响应头
        if ($display){
            $this->response->withHeader("Content-Disposition","inline");
        }else{
            $position  = "attachment";
            $this->response->withHeader("Content-Disposition",$position.";filename=".pathinfo($fileName,PATHINFO_BASENAME));
        }

        $this->response->withHeader("Content-Type","text/plain;charset=utf-8");

        //获取文件位置
        $file_location = $GLOBALS["super_config"]["resDir"].$fileName;

        if (file_exists($file_location)){

            $this->response->withFile($file_location);
            //输出文件内容
            $this->connection->send($this->response);
        }else{

            throw new FileNotFoundException();
        }
    }

    /**
     * @param string $fileName
     * @param bool $display
     * @return void
     * @throws FileNotFoundException
     */
    public function doJsonResponse(string $fileName, bool $display = true): void
    {
        //生成响应类
        $this->response->withHeaders($this->defaultHttpConfig->getOptions("headers"));

        //设置专用响应头
        if ($display){
            $this->response->withHeader("Content-Disposition","inline");
        }else{
            $position  = "attachment";
            $this->response->withHeader("Content-Disposition",$position.";filename=".pathinfo($fileName,PATHINFO_BASENAME));
        }

        $this->response->withHeader("Content-Type","text/json;charset=utf-8");

        //获取文件位置
        $file_location = $GLOBALS["super_config"]["resDir"].$fileName;

        if (file_exists($file_location)){

            $this->response->withFile($file_location);
            //输出文件内容
            $this->connection->send($this->response);
        }else{

            throw new FileNotFoundException();
        }
    }

    /**
     * @param string $fileName
     * @param bool $display
     * @return void
     * @throws FileNotFoundException
     */
    public function doXmlResponse(string $fileName, bool $display = true): void
    {
        //生成响应类
        $this->response->withHeaders($this->defaultHttpConfig->getOptions("headers"));

        //设置专用响应头
        if ($display){
            $this->response->withHeader("Content-Disposition","inline");
        }else{
            $position  = "attachment";
            $this->response->withHeader("Content-Disposition",$position.";filename=".pathinfo($fileName,PATHINFO_BASENAME));
        }

        $this->response->withHeader("Content-Type","text/xml;charset=utf-8");

        //获取文件位置
        $file_location = $GLOBALS["super_config"]["resDir"].$fileName;

        if (file_exists($file_location)){

            $this->response->withFile($file_location);
            //输出文件内容
            $this->connection->send($this->response);
        }else{

            throw new FileNotFoundException();
        }
    }

    /**
     * @param string $fileName
     * @param bool $display
     * @return void
     * @throws FileNotFoundException
     */
    public function doImageResponse(string $fileName, bool $display = true): void
    {
        //生成响应类
        $this->response->withHeaders($this->defaultHttpConfig->getOptions("headers"));

        //设置专用响应头
        if ($display){
            $this->response->withHeader("Content-Disposition","inline");
        }else{
            $position  = "attachment";
            $this->response->withHeader("Content-Disposition",$position.";filename=".pathinfo($fileName,PATHINFO_BASENAME));
        }

        $this->response->withHeader("Content-Type","image/".pathinfo($fileName,PATHINFO_EXTENSION).";charset=utf-8");

        //获取文件位置
        $file_location = $GLOBALS["super_config"]["resDir"].$fileName;

        if (file_exists($file_location)){

            $this->response->withFile($file_location);

            //输出文件内容
            $this->connection->send($this->response);
        }else{

            throw new FileNotFoundException();
        }
    }

    /**
     * @param string $fileName
     * @param bool $display
     * @return void
     * @throws FileNotFoundException
     */
    public function doVideoResponse(string $fileName, bool $display = true): void
    {
        //生成响应类
        $this->response->withHeaders($this->defaultHttpConfig->getOptions("headers"));

        //设置专用响应头
        if ($display){
            $this->response->withHeader("Content-Disposition","inline");
        }else{
            $position  = "attachment";
            $this->response->withHeader("Content-Disposition",$position.";filename=".pathinfo($fileName,PATHINFO_BASENAME));
        }

        $this->response->withHeader("Content-Type","video/".pathinfo($fileName,PATHINFO_EXTENSION).";charset=utf-8");

        //获取文件位置
        $file_location = $GLOBALS["super_config"]["resDir"].$fileName;

        if (file_exists($file_location)){

            $this->response->withFile($file_location);

            //输出文件内容
            $this->connection->send($this->response);
        }else{

            throw new FileNotFoundException();
        }
    }

    /**
     * @param string $fileName
     * @param bool $display
     * @return void
     * @throws FileNotFoundException
     */
    public function doAudioResponse(string $fileName, bool $display = true): void
    {
        //设置专用响应头
        if ($display){
            $this->response->withHeader("Content-Disposition","inline");
        }else{
            $position  = "attachment";
            $this->response->withHeader("Content-Disposition",$position.";filename=".pathinfo($fileName,PATHINFO_BASENAME));
        }

        $this->response->withHeader("Content-Type","audio/".pathinfo($fileName,PATHINFO_EXTENSION).";charset=utf-8");

        //获取文件位置
        $file_location = $GLOBALS["super_config"]["resDir"].$fileName;

        if (file_exists($file_location)){

            $this->response->withFile($file_location);

            //输出文件内容
            $this->connection->send($this->response);
        }else{

            throw new FileNotFoundException();
        }
    }

    /**
     * @param string $fileName
     * @return void
     * @throws FileNotFoundException
     */
    public function doResourceResponse(string $fileName):void
    {
        $this->response->withHeader("Content-Disposition","attachment;filename=".pathinfo($fileName,PATHINFO_BASENAME));

        $this->response->withHeader("Content-Type","application/".pathinfo($fileName,PATHINFO_EXTENSION).";charset=utf-8");

        //获取文件位置
        $file_location = $GLOBALS["super_config"]["resDir"].$fileName;

        if (file_exists($file_location)){

            $this->response->withFile($file_location);

            //输出文件内容
            $this->connection->send($this->response);
        }else{

            throw new FileNotFoundException();
        }
    }

    //http
    /**
     * @param string $url
     * @return void
     */
    public function reDirect(string $url):void{
        $response = new \Workerman\Protocols\Http\Response(302,['location'=>$url]);
        $this->connection->send($response);
    }

    /**
     * @param string $field
     * @param string $content
     * @return void
     */
    public function setHeader(string $field, string $content): void
    {
        $this->response->withHeader($field,$content);
    }

    /**
     * @param Exception $exception
     * @param int $code
     * @return void
     */
    public function doExceptionResponse(Exception $exception, int $code, int $httpCode = 200): void
    {
        //设置状态码
        $response = new \Workerman\Protocols\Http\Response($code);

        //设置通用响应头
        $response->withHeaders($this->defaultHttpConfig->getOptions("headers"));

        //设置专用响应头
        $response->withHeader("Content-Type","text/json:charset=utf-8");

        //数据格式
        $format = new ExceptionFormat($code,"Exception","String",$exception->getMessage());

        //返回数据
        $response->withBody(json_encode($format->format(),JSON_UNESCAPED_UNICODE));
    }

    //view

    /**
     * @param string $fileName
     * @return void
     * @throws FileNotFoundException
     */
    public function doViewResponse(string $fileName):void
    {
        //生成响应类
        $this->response->withHeaders($this->defaultHttpConfig->getOptions("headers"));

        //获取文件位置
        $file_location = $GLOBALS["super_config"]["resDir"].$fileName;

        if (file_exists($file_location)){
            $this->response->withHeader("Content-Type","text/".pathinfo($fileName,PATHINFO_EXTENSION).";charset=utf-8");

            $this->response->withFile($file_location);

            //输出文件内容
            $this->connection->send($this->response);
        }else{

            throw new FileNotFoundException();
        }
    }

    /**
     * @param FormatClient $format
     * @param int $code
     * @param int $httpCode
     * @return void
     */
    public function doFormatResponse(FormatClient $format, int $code, int $httpCode = 200): void
    {
        //设置状态码
        $response = new \Workerman\Protocols\Http\Response($code);

        //生成响应类
        $this->response->withHeaders($this->defaultHttpConfig->getOptions("headers"));

        //设置专用响应头
        $response->withHeader("Content-Type","text/json:charset=utf-8");

        //返回数据
        die(json_encode($format->format(),JSON_UNESCAPED_UNICODE));
    }
}