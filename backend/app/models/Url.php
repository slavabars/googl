<?php
use Phalcon\Mvc\Model;

class Url extends Model
{
    protected $url;
    protected $short;

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getShort()
    {
        return $this->short;
    }

    public function setShort($short)
    {
        $this->short = $short;
    }

    public function initialize()
    {
        $this->setSource('url');
    }
}