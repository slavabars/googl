<?php
namespace rpc;

class Client
{
    const VERSION = '2.0';
    private $url = 'http://localhost:8001/';
    protected $method;
    protected $params;

    public function __construct(string $method, array $params){
        $this->method = $method;
        $this->params = $params;
    }

    public function send() : Response{
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
            'method' => $this->method,
            'params' => $this->params,
            'id' => microtime(),
            'jsonrpc' => self::VERSION
        ]));
        $result = curl_exec($curl);
        curl_close($curl);

        return new Response($result);
    }

}