<?php

namespace Tests;
require 'vendor/autoload.php';
require_once 'Message.php';

use PHPUnit\Framework\TestCase;
use RndIT\PDS\Message\Message;
use RndIT\PDS\Message\Meta;
class MessageDTOTest extends TestCase {
    public function test_IsEmptyMessage(){
        $meta = [   'metaParam1'=>'Param1Value',
                    'metaParam2'=>'Param2Value' ];

          $objMeta = new Meta($meta);
          $serializeMeta = $objMeta->serialize();
        // echo '--------------------'.PHP_EOL;

        $msg = new Message($objMeta);
        // echo '--------------------'.PHP_EOL;
        // echo var_dump($msg->getMeta()->getData());
        echo $msg->serialize();
        //$this->assertEquals($msg, Message::unserialize($msg->serialize()));
    }
}

$test = new MessageDTOTest('Test Message DTO');
$test->test_IsEmptyMessage();