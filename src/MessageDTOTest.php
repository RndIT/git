<?php

namespace Tests;

require '../vendor/autoload.php';
require_once 'Message.php';

use PHPUnit\Framework\TestCase;
use RndIT\PDS\Message\Message;
use RndIT\PDS\Message\Meta;

class MessageDTOTest extends TestCase
{

    public function test_Meta_Not_Empty()
    {
        $meta = [
            'metaParam1' => 'Param1Value',
            'metaParam2' => 'Param2Value'
        ];

        $objMeta = new Meta($meta);
        echo 'Source meta object dump' . PHP_EOL;
        var_dump($objMeta);

        $serializeMeta = $objMeta->serialize();
        var_dump($serializeMeta);
        $unserMeta = Meta::unserialize($serializeMeta);
        var_dump($unserMeta);
        $this->assertEquals($objMeta, $unserMeta);
    }

    public function test_Message_NotEmpty()
    {
        $meta = [
            'metaParam1' => 'Param1Value',
            'metaParam2' => 'Param2Value'
        ];

        $objMeta = new Meta($meta);
        $msg = new Message($objMeta);
        // echo '---------Original Message-----------' . PHP_EOL;
        // var_dump($msg);
        // echo '---------Serialized Message-----------' . PHP_EOL;
        // $serMessage = $msg->serialize();
        // var_dump($serMessage);
        // echo '---------Deserialized Message-----------' . PHP_EOL;
        // $dsMessage = Message::unserialize($serMessage);
        // var_dump($dsMessage);

        $this->assertEquals($msg, Message::unserialize($msg->serialize()), 'Message objects not equals!');

    }
}

$test = new MessageDTOTest('Test Message DTO');
$test->test_Meta_Not_Empty();
$test->test_Message_NotEmpty();