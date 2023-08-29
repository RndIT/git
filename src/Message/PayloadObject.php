<?php
namespace RndIT\PDS\Message;

require_once('Tr_WithSerialization.php');
use RndIT\PDS\Message\Traits\WithSerialization;

require_once('DTO_AddObjectData.php');
use RndIT\PDS\Message\DTO_AddObjectData;

class Payload extends DTO_AddObjectData
{
    use WithSerialization;
 
}