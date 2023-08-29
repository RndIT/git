<?php

namespace RndIT\PDS\Message;

require_once 'Message/EventObject.php';
require_once 'Message/MetaObject.php';
require_once 'Message/PayloadObject.php';
require_once 'Message/Tr_WithSerialization.php';

use RndIT\PDS\Message\Traits\WithSerialization;
use RndIT\PDS\Message\Event;
use RndIT\PDS\Message\Meta;
use RndIT\PDS\Message\Payload;


/**
 * Класс, реализующий объект Сообщение, состояние которого 
 * можно сохранять и восстанавливать из JSON вместе с вложенными объектами.
 */
class Message
{
    use WithSerialization;

    private $objectData = null;

    /**
     * Summary of __construct
     * @param Meta|null $meta
     * @param Event|null $event
     * @param Payload|null $payload
     */
    public function __construct(
        ?Meta $meta = null, 
        ?Event $event = null, 
        ?Payload $payload = null)
    {
        isset($meta) ? $this->objectData['Meta'] = $meta : $this->objectData['Meta'] =new Meta($meta);
        isset($event) ? $this->objectData['Event'] = $event : new Event($event);
        isset($payload) ? $this->objectData['Payload'] = $payload : new Payload($payload); 
    }


    public function setMeta(?Meta $value = null) : static
    {
        $this->objectData['Meta'] = $value;
        return $this;
    }

    public function getMeta(): Meta
    {
        return $this->objectData['Meta'];
    }


    public function setEvent(?Event $value = null) : static
    {
        $this->objectData['Event'] = $value;
        return $this;
    }

    public function getEvent(): Event
    {
        return $this->objectData['Event'];
    }

    public function setPayload(?Payload $value = null) : static
    {
        $this->objectData['Payload'] = $value;
        return $this;
    }

    public function getPayload(): Payload
    {
        return $this->objectData['Payload'];
    }

}


$m=new Message();

$s =$m->serialize();
var_dump($s);

$o = Message::deserialize($s);
var_dump($o);