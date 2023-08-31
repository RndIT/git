<?php

namespace Tests;

require '../vendor/autoload.php';
require_once 'Message.php';

use PHPUnit\Framework\TestCase;
use RndIT\PDS\Message\Message;
use RndIT\PDS\Message\Meta;
use RndIT\PDS\Message\Event;
use RndIT\PDS\Message\Payload;


class NestedDemo {
    public $one = 1;

    public function return_one() {
        return $this->one;
    }
} 
#[AllowDynamicProperties]
class MessageEntityTest extends TestCase
{



    public function test_Message_NotEmpty()
    {
        $msg = new Message(    new Meta('meta'),
                        new Event( 'event data'),
                        new Payload( 'payload data info text')
                    );

        // добавляю nested класс как поле

        $msg->nested = new NestedDemo;

        $this->assertEquals($msg, Message::deserialize($msg->serialize()), 'Message objects not equals!');
        $this->assertEquals(1, Message::deserialize($msg->serialize())->nested->return_one(), 'Message objects not equals!');
    }

    public function test_Message_Is_Empty()
    {
        $msg = new Message();
        $this->assertEquals($msg, Message::deserialize($msg->serialize()), 'Message objects not equals!');

    }    
}

$test = new MessageEntityTest('Test Message serialization');

$test->test_Message_NotEmpty();
$test->test_Message_Is_Empty();
echo 'Testing is done'.PHP_EOL;