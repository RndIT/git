<?php

namespace RndIT\PHPDemoSerialize\Objects\Message\Traits;

/*
Данное расширение реализовывает механизм сериализации
*/
trait Tr_WithSerialization
{
    // Для выбранного объекта (к которому применяется trait) производится конвертация в JSON-строку
    public function serialize(): string
    {
        return serialize($this);
    }

    // Из переданной строки производится попытка десериализовать объект. 
    public static function deserialize(string $value):  static
    {
        return unserialize($value);
    }


}