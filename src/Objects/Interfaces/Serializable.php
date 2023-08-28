<?php

namespace RndIT\PHPDemoSerialize\Objects\Interfaces;

/**
 * Данный интерфейс определяет функциональность по сериализации.
 */
interface I_Serializable
{
    public function serialize():string;

    public static function deserialize(string $val) : static;
}