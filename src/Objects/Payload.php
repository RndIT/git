<?php

namespace RndIT\PHPDemoSerialize\Objects\Message;

class Payload extends DTO_AddObjectData
{
    public function __construct(private mixed $data)
    {
        isset($data) ?  $this->data = $data : $this->data = '';
    }

    public function setData(mixed $data)
    {
        isset($data) ?  $this->data = $data : $this->data = '';
        return $this;
    }

    public function getData(): mixed
    {
        return $this->data;
    }  
}