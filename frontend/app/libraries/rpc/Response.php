<?php
namespace rpc;

class Response
{
    protected $response;
    protected $success;

    public function __construct($response){
        $this->response = json_decode($response, false, 512, JSON_PARTIAL_OUTPUT_ON_ERROR);
        $this->success = !isset($this->response->error);
    }

    public function isSuccess() : bool {
        return $this->success;
    }

    public function getResult(){
        return $this->response->result;
    }

    public function getErrorCode() : int {
        return $this->response->error->code;
    }

    public function getErrorMessage() : string{
        return $this->response->error->message;
    }
}