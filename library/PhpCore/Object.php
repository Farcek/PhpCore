<?php
/**
 * Created by Farcek.
 * User: Farcek@gmail.com
 * Date: 10/30/11
 * Time: 5:04 PM
 */
namespace PhpCore;
class Object extends \stdClass{
    function __construct(array $initData){
        //var_dump($initData);
        $this->setInitData($initData);
    }
    function __set($name,$value){
        throw new \BadMethodCallException(
            sprintf("Unknown property '%s' on class '%s'.", $name, get_class($this))
        );
    }
    public function __get($name){
         throw new \BadMethodCallException(
            sprintf("Unknown property '%s' on class '%s'.", $name, get_class($this))
        );
    }

    public function setInitData(array $data,$ignoreProperty = false){
        foreach($data as $name=>$it){
            if(is_string($name) && property_exists($this,$name)){
                $this->$name = $it;
                continue;
            }
            if(!$ignoreProperty){
                user_error(sprintf("Unknown property '%s' on class '%s'.", $name, get_class($this)));
            }
        }
    }
}
