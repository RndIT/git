<?php

namespace RndIT\PHPDemoSerialize\Objects\Message;


use RndIT\PHPDemoSerialize\Objects\Message\Interfaces\I_Serializable;
use RndIT\PHPDemoSerialize\Objects\Message\Traits\Tr_WithSerialization;

/**
 * DTOAddData добавляет сериализируемое поле $objectData в котором хранятся пользовательские данные
 */
class DTO_AddObjectData implements I_Serializable {
    use Tr_WithSerialization;  // подключили возможность кастомно сериализовать объект (имплементация интерфейса сериализации)

    protected mixed $objectData = null; // пользовательские данные объекта

    /**
     * Записать данные объекта (fluent-setter)
     * @param mixed|null $data
     * @return static
     */
    public function setData(mixed $data=null) : static {
         
        if (is_null($data)) // Очистка данных
        {
            $this->objectData = null;
            return $this;
        }
        $this->objectData = $data;
        return $this;
    }

    /**
     * Получить информацию из объекта
     * @return mixed
     */
    public function getData() : mixed {
        return $this->objectData;
    }
}

