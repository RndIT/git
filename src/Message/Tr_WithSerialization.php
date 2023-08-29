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


        $thisClassName = get_class($this); // Получаю имя сериализуемого класса
        if (strpos($thisClassName, constMessageClassName) !== false) {
            // Сериализуется исходный объект "Сообщение"
            // Надо перебрать все входящие в него объекты (хотя бы в плоской модели)
            // и  если там есть интерфейс сериализации - вызвать его и сохранить.
            $sObjectMessageItems = array();
            foreach (array('Meta', 'Event', 'Payload') as $key) {
                if (in_array($key, array_keys($this->objectData))) {
                    array_push($sObjectMessageItems, $this->objectData[$key]->serialize());
                }
            }
            return json_encode(array($thisClassName => $sObjectMessageItems));
        } else {
            return json_encode(array($thisClassName => $this->objectData));
        }
    }


    /**
     * Из переданной строки производится попытка десериализовать объект. 
     * @param string $value JSON-строка для восстановления объекта
     * @return static
     */
    public static function deserialize(string $data): static
    {
        $arrDeserialized = json_decode($data, true);
        if ($arrDeserialized === null) {
            return new Message();
        }
        if (strcmp(array_key_first($arrDeserialized), constMessageClassName) !== 0) {
            // на входе - сериализованый субкласс
            if (array_key_exists(constMessageMetaClassName, $arrDeserialized)) {
                // Восстанавливаю вложенный объект Meta
                return new Meta($arrDeserialized[constMessageMetaClassName]);
            }
            if (array_key_exists(constMessageEventClassName, $arrDeserialized)) {
                // Восстанавливаю вложенный объект Meta
                return new Event($arrDeserialized[constMessageEventClassName]);
            }
            if (array_key_exists(constMessagePayloadClassName, $arrDeserialized)) {
                // Восстанавливаю вложенный объект Meta
                return new Payload($arrDeserialized[constMessagePayloadClassName]);
            }
        } else {
            // Восстанавливаю исходный класс с подклассами
            $subClasses = $arrDeserialized[constMessageClassName];
            $meta = null;

            foreach ($subClasses as $rec) {
                $x = json_decode($rec, true);
                $name = array_key_first($x);
                if (strcmp($name, constMessageMetaClassName) === 0) {
                    $meta = new Meta($x[$name]);
                }

                if (strcmp($name, constMessageEventClassName) === 0) {
                    $meta = new Event($x[$name]);
                }

                if (strcmp($name, constMessagePayloadClassName) === 0) {
                    $meta = new Payload($x[$name]);
                }                
            }
            return new Message($meta);
        }
    }
}