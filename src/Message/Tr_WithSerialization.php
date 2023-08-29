<?php

namespace RndIT\PDS\Message\Traits;

use RndIT\PDS\Message\Meta;
use RndIT\PDS\Message\Event;
use RndIT\PDS\Message\Payload;

use RndIT\PDS\Message\Message;

/**
 * Трейт Tr_WithSerialization реализовывает механизм сериализации
 */

define('constMessageClassName', 'RndIT\PDS\Message\Message');
define('constMessageMetaClassName', 'RndIT\PDS\Message\Meta');
define('constMessageEventClassName', 'RndIT\PDS\Message\Event');
define('constMessagePayloadClassName', 'RndIT\PDS\Message\Payload');



trait WithSerialization
{
    /**
     * Для выбранного объекта (к которому применяется trait) производится конвертация в JSON-строку
     * @return string Сериализованный в JSON-строку объект
     */
    public function serialize(): string
    {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($this);
        
    
        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return json_encode( array_map(__FUNCTION__, $d) );
        } else {
            // Return array
            return json_encode($d);
        }

    }


    /**
     * Из переданной строки производится попытка десериализовать объект. 
     * @param string $value JSON-строка для восстановления объекта
     * @return static
     */
    public static function deserialize(string $data): static
    {
        $d = json_decode($data, true);
        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return (object) array_map(__FUNCTION__, $d);
        } else {
            // Return object
            return $d;
        }
    }
}