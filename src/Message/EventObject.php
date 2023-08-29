<?php
namespace RndIT\PDS\Message;

require_once('Tr_WithSerialization.php');
use RndIT\PDS\Message\Traits\WithSerialization;

require_once('DTO_AddObjectData.php');
use RndIT\PDS\Message\DTO_AddObjectData;

class Event extends DTO_AddObjectData
{
    use WithSerialization;
    public function __construct(private ?array $data=null)
    {
        isset($data) ?  $this->data = $data : $this->data = array();
    }

    public function setData(?array $data = null)
    {
        isset($data) ?  $this->data = $data : $this->data = array();
        return $this;
    }

    public function getData(): mixed
    {
        return $this->data;
    }  
}