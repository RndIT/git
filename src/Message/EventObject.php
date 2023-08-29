<?php
namespace RndIT\PDS\Message;
require_once 'JsonDeserilizator.php';

class Event extends JsonDeserializer
{
    public function __construct(public ?string $str=null)
    {
        $this->str = $str;
    }

     public function setInfo(?string $data = null)
    {
        $this->str = $data;
        return $this;
    }

    public function getInfo(): string
    {
        return $this->str;
    }  
}