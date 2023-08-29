<?php

namespace Tests;

require '../vendor/autoload.php';
require_once 'Message.php';

use PHPUnit\Framework\TestCase;
use RndIT\PDS\Message\Message;
use RndIT\PDS\Message\Meta;
use RndIT\PDS\Message\Event;
use RndIT\PDS\Message\Payload;

class MessageDTOTest extends TestCase
{

    public function test_Meta_Not_Empty()
    {
        $meta = [
            'metaParam1' => 'Param1Value',
            'metaParam2' => 'Param2Value'
        ];

        $objMeta = new Meta($meta);
        $this->assertEquals($objMeta, Meta::deserialize($objMeta->serialize()));
    }

    public function test_Meta_Is_Empty()
    {
        $objMeta = new Meta();
        $this->assertEquals($objMeta, Meta::deserialize($objMeta->serialize()));
    }    


    public function test_Event_Not_Empty()
    {
        $obj = new Event( array (   
                    'eventParam1' => 'Param1Value',
                    'eventParam2' => 'Param2Value'));
        $this->assertEquals($obj, Event::deserialize($obj->serialize()));
    }

    public function test_Event_Is_Empty()
    {
        $obj = new Event();
        $this->assertEquals($obj, Event::deserialize($obj->serialize()));
    }        


    public function test_Payload_Not_Empty()
    {
        $obj = new Payload( array (   
                    'plParam1' => 'Param1Value',
                    'plParam2' => 'Param2Value'));
        $this->assertEquals($obj, Payload::deserialize($obj->serialize()));
    }

    public function test_Payload_Is_Empty()
    {
        $obj = new Payload();
        $this->assertEquals($obj, Payload::deserialize($obj->serialize()));
    }  

    public function test_Message_NotEmpty()
    {
        $meta = [
            'metaParam1' => 'Param1Value',
            'metaParam2' => 'Param2Value'
        ];

        $msg = new Message(new Meta($meta));
        $this->assertEquals($msg, Message::deserialize($msg->serialize()), 'Message objects not equals!');

        $msg2 = new Message(    new Meta($meta),
                                new Event( array (   
                                    'eventParam1' => 'Param1Value',
                                    'eventParam2' => 'Param2Value') )
                            );
        $this->assertEquals($msg2, Message::deserialize($msg2->serialize()), 'Message objects not equals!');

        $msg3 = new Message(    new Meta($meta),
                                new Event( array (   
                                    'eventParam1' => 'Param1Value',
                                    'eventParam2' => 'Param2Value') ),
                                new Payload( array (   
                                    'plParam1' => 'Param1Value',
                                    'plParam2' => 'Param2Value') )
                            );
        $this->assertEquals($msg3, Message::deserialize($msg3->serialize()), 'Message objects not equals!');

    }

    public function test_Message_Is_Empty()
    {
        $msg = new Message();
        $this->assertEquals($msg, Message::deserialize($msg->serialize()), 'Message objects not equals!');

    }    
}

$test = new MessageDTOTest('Test Message serialization');
$test->test_Meta_Is_Empty();
$test->test_Meta_Not_Empty();
$test->test_Event_Is_Empty();
$test->test_Event_Not_Empty();
$test->test_Payload_Is_Empty();
$test->test_Payload_Not_Empty();
$test->test_Message_NotEmpty();
$test->test_Message_Is_Empty();
echo 'Testing is done'.PHP_EOL;