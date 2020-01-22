<?php


class LinkGenerate
{
    public function getUrl($url) : string {
        $link = Url::findFirst("url = '$url'");
        if(is_null($link)){
            $short = self::getShort(4);

            $link = new Url;
            $link->url = $url;
            $link->short = $short;
            $link->save();
        }
        return $link->short;
    }

    function getShort($len) : string {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $text = [];
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $len; $i++) {
            $n = rand(0, $alphaLength);
            $text[] = $alphabet[$n];
        }
        $url = implode($text);

        $test = Url::findFirst("short = '$url'");
        if(!is_null($test)){
            return self::getShort(4);
        }

        return $url;
    }
}