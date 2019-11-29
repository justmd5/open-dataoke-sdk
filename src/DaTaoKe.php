<?php


namespace Justmd5\DaTaoKe;


use Hanson\Foundation\Foundation;

class DaTaoKe extends Foundation
{

    public function request($method, $params)
    {
        $api = new Api($this->getConfig('key'), $this->getConfig('secret'),$this->getConfig('version')?:'v1.1.1');

        return $api->request($method, $params);
    }

}