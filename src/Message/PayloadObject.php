<?php
namespace RndIT\PDS\Message;


class Payload
{
    public function __construct(private ?string $str=null)
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