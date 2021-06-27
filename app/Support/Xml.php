<?php

namespace App\Support;

use SimpleXMLElement;

class Xml
{
    /**
     * @var \SimpleXMLElement
     */
    private $xml;

    /**
     * @param \SimpleXMLElement $xml
     */
    public function __construct(SimpleXMLElement $xml)
    {
        $this->xml = $xml;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $json = json_encode($this->xml);
        return json_decode($json, true);
    }
}
