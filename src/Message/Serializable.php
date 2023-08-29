<?php

namespace RndIT\PDS\Message\Interfaces;

/**
 * Данный интерфейс определяет функциональность по сериализации.
 */
interface Serializable
{
    public function serialize(): string;

    public static function unserialize(string $data): static;
}