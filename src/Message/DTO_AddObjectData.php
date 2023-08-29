<?php

namespace RndIT\PDS\Message;

require_once('Tr_WithSerialization.php');
use RndIT\PDS\Message\Traits\WithSerialization;

require_once('Serializable.php');
use RndIT\PDS\Message\Interfaces\Serializable;


/**
 * DTOAddData добавляет сериализируемое поле $objectData в котором хранятся пользовательские данные
 */
class DTO_AddObjectData implements Serializable
{
    use WithSerialization; // подключили возможность кастомно сериализовать объект (имплементация интерфейса сериализации)

    protected array $objectData = array(); // пользовательские данные объекта

    public function __construct(?array $data=null)
    {
        isset($data) ?  $this->objectData = $data : $this->objectData = array();
    }

    public function setData(?array $data = null)
    {
        isset($data) ?  $this->objectData = $data : $this->objectData = array();
        return $this;
    }

    public function getData(): mixed
    {
        return $this->objectData;
    }  
}

