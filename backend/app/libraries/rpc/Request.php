<?php
namespace rpc;

class Request
{
    protected $request;
    protected $success;

    public function __construct($request){
        $this->request = $request;
        $this->success = isset($this->request->jsonrpc);
    }

    public function isSuccess() : bool {
        return $this->success;
    }

    public function getMethod() : string {
        return $this->request->method;
    }

    public function getParams(){
        return $this->request->params;
    }

    public function getId() : int {
        return $this->request->id;
    }
}