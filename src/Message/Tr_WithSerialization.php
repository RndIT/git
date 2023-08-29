<?php

namespace RndIT\PDS\Message\Traits;

use RndIT\PDS\Message\Meta;
use RndIT\PDS\Message\Message;

/**
 * Трейт Tr_WithSerialization реализовывает механизм сериализации
 */

define('constMessageClassName', 'RndIT\PDS\Message\Message');
define('constMessageMetaClassName', 'RndIT\PDS\Message\Meta');


trait WithSerialization
{
    /**
     * Для выбранного объекта (к которому применяется trait) производится конвертация в JSON-строку
     * @return string Сериализованный в JSON-строку объект
     */
    public function serialize(): string
    {


        $thisClassName = get_class($this);
        echo 'SERIALIZE(' . $thisClassName . ')' . PHP_EOL;

        if (strpos($thisClassName, constMessageClassName) !== false) {
            // Сериализуется исходный объект "Сообщение"
            // Надо перебрать все входящие в него объекты (хотя бы в плоской модели)
            // и  если там есть интерфейс сериализации - вызвать его и сохранить.
            $sObjectMessageItems = array();
            array_push($sObjectMessageItems, $this->objectData['Meta']->serialize());
            return json_encode(array($thisClassName => $sObjectMessageItems));
        } else {
            echo "Ser other object" . PHP_EOL;
            return json_encode(array($thisClassName => $this->objectData));
        }

        // //return serialize($this);
        // echo '++++ObjectData of '.get_class($this).PHP_EOL;
        // var_dump($this);
        // echo json_encode($this->objectData['Meta']->getData(), JSON_PRETTY_PRINT);
        // echo PHP_EOL.'---ObjectData'.PHP_EOL;

        // echo '++++ObjectData[Meta]'.PHP_EOL;
        // echo $this->objectData['Meta'];
        // echo PHP_EOL.'----ObjectData[Meta]'.PHP_EOL;


        return json_encode($this->objectData['Meta']->getData(), JSON_FORCE_OBJECT);
    }


    /**
     * Из переданной строки производится попытка десериализовать объект. 
     * @param string $value JSON-строка для восстановления объекта
     * @return static
     */
    public static function unserialize(string $data): static
    {
        $arrDeserialized = json_decode($data, true);
        echo '__ARR DESERIALIZED__'.PHP_EOL;
        var_dump($arrDeserialized);
        if (strcmp(array_key_first($arrDeserialized), constMessageClassName) !== 0) {
            // на входе - сериализованый субкласс
            if (array_key_exists(constMessageMetaClassName, $arrDeserialized)) {
                // Восстанавливаю вложенный объект Meta
                return new Meta($arrDeserialized[constMessageMetaClassName]);
            }
        } else {
            // Восстанавливаю исходный класс с подклассами
            echo 'Restore Message class'.PHP_EOL;
            $subClasses = $arrDeserialized[constMessageClassName];
            $meta = null;

            foreach( $subClasses as $name => $value ){
                if (strcmp($name, constMessageMetaClassName)===0){
                    echo 'Restore sub meta---'.PHP_EOL;
                    var_dump($value);
                    $meta = new Meta($value[constMessageMetaClassName]);
                }
            }
            $message = new Message($meta);
            var_dump($message);
            return $message;
        }


        return json_decode($data);
    }


}