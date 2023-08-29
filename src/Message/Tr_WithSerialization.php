<?php

namespace RndIT\PDS\Message\Traits;
/**
 * Трейт Tr_WithSerialization реализовывает механизм сериализации
 */
trait WithSerialization
{
    /**
     * Для выбранного объекта (к которому применяется trait) производится конвертация в JSON-строку
     * @return string Сериализованный в JSON-строку объект
     */
    public function serialize(): string
    {

        
        $thisClassName = get_class($this);
        $messageClassSubName = 'RndIT\PDS\Message\Message';
        $serializeInterface = 'RndIT\PDS\Message\Interfaces\Serializable';
        echo 'SERIALIZE('.$thisClassName.')'.PHP_EOL;

        if( strpos($thisClassName, $messageClassSubName)!==false ){
            // Сериализуется исходный объект "Сообщение"
            echo "Ser Message".PHP_EOL;
            // Надо перебрать все входящие в него объекты (хотя бы в плоской модели)
            // и  если там есть интерфейс сериализации - вызвать его и сохранить.
            $sObjectMessageItems = array();
            array_push($sObjectMessageItems, $this->objectData['Meta']->serialize() );
            return json_encode( array($thisClassName => $sObjectMessageItems));


            // $childsClassVarsNames = get_class_vars($thisClassName);
            // foreach($childsClassVarsNames as $cVN=>$cVK){
            //     $classInterfaces = class_implements($cVN);
            //     var_dump($classInterfaces);
            //     echo $cVN.PHP_EOL;
            //     if ( in_array($serializeInterface, $classInterfaces) ){
            //         echo $cVN;
            //         $sObjectMessageItems[$cVN] = $this->objectData[$cVN]->serialize();
            //     }
            //     echo var_dump($sObjectMessageItems);
                // if ()
            // }
        } else {
            echo "Ser other object".PHP_EOL;
            return json_encode( array($thisClassName => $this->objectData) );
        }
        
        // //return serialize($this);
        // echo '++++ObjectData of '.get_class($this).PHP_EOL;
        // var_dump($this);
        // echo json_encode($this->objectData['Meta']->getData(), JSON_PRETTY_PRINT);
        // echo PHP_EOL.'---ObjectData'.PHP_EOL;

        // echo '++++ObjectData[Meta]'.PHP_EOL;
        // echo $this->objectData['Meta'];
        // echo PHP_EOL.'----ObjectData[Meta]'.PHP_EOL;


        return json_encode($this->objectData['Meta']->getData(), JSON_FORCE_OBJECT);
    }


    /**
     * Из переданной строки производится попытка десериализовать объект. 
     * @param string $value JSON-строка для восстановления объекта
     * @return static
     */
    public static function unserialize(string $data): array
    {
        //return unserialize($data);
        return json_decode($data);
    }


}