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

    /**
     * Записать данные объекта (fluent-setter)
     * @param mixed|null $data
     * @return static
     */
    public function setData(?array $data = null)
    {

        if (is_null($data)) // Очистка данных
        {
            $this->objectData = array();
            return $this;
        }
        $this->objectData = $data;
        return $this;
    }

    /**
     * Получить информацию из объекта
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->objectData;
    }
}

