<?php

namespace Tests;

use RndIT\PHPDemoSerialize\Objects\Message\Message;
use PHPUnit\Framework\TestCase;

require 'vendor/autoload.php';

class MessageDTOTest extends TestCase {
    public function test_IsEmptyMessage(){
        $msg = new Message();
        $this->assertEquals($msg, Message::deserialize($msg->serialize()));
    }
}

$test = new MessageDTOTest('Test Message DTO');
$test->test_IsEmptyMessage();