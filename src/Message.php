<?php

namespace RndIT\PDS\Message;

require_once './Message/JsonDeserilizator.php';
require_once './Message/EventObject.php';
require_once './Message/MetaObject.php';
require_once './Message/PayloadObject.php';




/**
 * Класс, реализующий объект Сообщение, состояние которого 
 * можно сохранять и восстанавливать из JSON вместе с вложенными объектами.
 */
class Message extends JsonDeserializer
{


    public $objectData = null;

    /**
     * Summary of __construct
     * @param Meta|null $meta
     * @param Event|null $event
     * @param Payload|null $payload
     */
    public function __construct(
        public ?Meta $meta = null, 
        public ?Event $event = null, 
        public ?Payload $payload = null)
    {
        isset($meta) ? $this->objectData['Meta'] = $meta : $this->objectData['Meta'] =new Meta($meta);
        isset($event) ? $this->objectData['Event'] = $event : $this->objectData['Event'] = new Event($event);
        isset($payload) ? $this->objectData['Payload'] = $payload : $this->objectData['Payload'] = new Payload($payload); 
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

$msg = new Message(    new Meta('meta'),
                        new Event( 'event data'),
                        new Payload( 'payload data info text')
                    );
$s = json_encode($msg, JSON_FORCE_OBJECT);
var_dump($msg);
var_dump($s);

$o = Message::DeserializeArray($s);

var_dump($o);