<?php

namespace RndIT\PHPDemoSerialize\Objects\Message;

use RndIT\PHPDemoSerialize\Objects\Message\DTO_AddObjectData;

class Event extends DTO_AddObjectData
{
    public function __construct(private ?string $title = null)
    {
        isset($title) ?  $this->title = $title : $this->title = '';
    }

    public function setTitle(?string $title)
    {
        isset($title) ?  $this->title = $title : $this->title = '';
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}