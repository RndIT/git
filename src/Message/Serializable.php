<?php

namespace RndIT\PDS\Message\Interfaces;

/**
 * Данный интерфейс определяет функциональность по сериализации.
 */
interface Serializable
{
    public function serialize(): string;

    public static function deserialize(string $data): static;
}