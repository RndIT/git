<?php
namespace RndIT\PDS\Message;

abstract class JsonDeserializer
{
    public function serialize() : string
    {
        return serialize($this);
    }
    /**
     * @param string $json
     * @return $this[]
     */
    public static function deserialize($json) : mixed
    {
        return unserialize($json);
    }
}
