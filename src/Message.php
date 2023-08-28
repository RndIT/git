<?php

namespace RndIT\PHPDemoSerialize\Objects\Message;

use RndIT\PHPDemoSerialize\Objects\Interfaces\I_Serializable;
use RndIT\PHPDemoSerialize\Objects\Traits\Tr_WithSerialization;

class Message implements I_Serializable
{
    use Tr_WithSerialization;

    public function __construct(
        private ?Meta $meta = new Meta(),
        private ?Event $event = null,
        private ?Payload $payload = null
    ) {
    }


    public function setMeta(?Meta $value=null)
    {
        $this->meta=$value;
        return $this;
    }

    public function getMeta():Meta{
        return $this->meta;
    }


    public function setEvent(?Event $value=null)
    {
        $this->event=$value;
        return $this;
    }

    public function getEvent():Event{
        return $this->meta;
    }

    public function setPayload(?Payload $value=null)
    {
        $this->payload=$value;
        return $this;
    }

    public function getPayload():Payload{
        return $this->payload;
    }

    


}