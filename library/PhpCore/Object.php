<?php
/**
 * Created by Farcek.
 * User: Farcek@gmail.com
 * Date: 10/30/11
 * Time: 5:04 PM
 */
namespace PhpCore;
class Object extends \stdClass{
    function __set($name,$value){
        $cls = get_class($this);
        trigger_error("Undefined property: $cls::$name");
    }
}
