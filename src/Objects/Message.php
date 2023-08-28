<?php

namespace RndIT\PHPDemoSerialize\Objects\Message;

use RndIT\PHPDemoSerialize\Objects\Message\Interfaces\I_Serializable;
use RndIT\PHPDemoSerialize\Objects\Message\Traits\Tr_WithSerialization;

/**
 * Summary of Message
 */
class Message implements I_Serializable
{
    use Tr_WithSerialization;

    /**
     * Summary of __construct
     * @param Meta|null $meta
     * @param Event|null $event
     * @param Payload|null $payload
     */
    public function __construct(
        private ?Meta $meta = new Meta('any_meta'), private ?Event $event = new Event('any event'), private ?Payload $payload = new Payload('any payload'))
    {
    }


    public function setMeta(?Meta $value = null)
    {
        $this->meta = $value;
        return $this;
    }

    public function getMeta(): Meta
    {
        return $this->meta;
    }


    public function setEvent(?Event $value = null)
    {
        $this->event = $value;
        return $this;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setPayload(?Payload $value = null)
    {
        $this->payload = $value;
        return $this;
    }

    public function getPayload(): Payload
    {
        return $this->payload;
    }




}