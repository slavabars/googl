<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Http\Request;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Url as UrlValidator;


class IndexController extends Controller
{

    private $idRespose = 1;
    private $content = [];

    public function indexAction(){

        if (true === $this->request->isPost()){
            $request = $this
                ->request
                ->getJsonRawBody();

            $result = new \rpc\Request($request);

            if($result->isSuccess()){
                $url = $result->getParams()->url;

                $validation = new Validation();
                $validation->add(
                    'url',
                    new UrlValidator(
                        [
                            'message' => 'Url error',
                        ]
                    )
                );

                if(!$validation->validate(['url'=>$url])->valid()){

                    $short = new LinkGenerate();

                    $this->content = [
                        'jsonrpc'=>"2.0",
                        'result'=>[
                            'url'=>$short->getUrl($url),
                        ],
                        'id'=>$this->idRespose
                    ];
                }
            }
        }

        if(!array_key_exists('result',$this->content)){
            $this->content = [
                'jsonrpc'=>"2.0",
                'error'=>[
                    'code'=>'500',
                    'message'=>'Url error',
                ],
                'id'=>$this->idRespose
            ];
        }
        $response = new Response();
        $response->sendHeaders('Content-Type', 'application/json');
        $response->setContent(json_encode($this->content));
        return $response;
    }
}