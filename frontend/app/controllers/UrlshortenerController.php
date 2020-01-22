<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;


class UrlshortenerController extends Controller
{
    public function indexAction(){
        if (true === $this->request->isPost()){
            $url = $this
                ->request
                ->getPost('url');
            $rpc = new \rpc\Client('get.url',['url'=>$url]);
            $result = $rpc->send();
            if($result->isSuccess()){
                print_r($result->getResult());
            }else{
                print_r($result->getErrorMessage());
            }
        }
    }
}