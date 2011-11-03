<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 10/30/11
 * Time: 9:00 PM
 */

include ("init.php");

$product = new myLib\Product();
$product->saveEvent->addListeners('eventHandler',null);
$product->name="mild seven";
$product->code="01";
$product->save();



$ev = new PhpCore\Event("eventName");
$ev->addListeners("eventHandler");
$ev->fire(null,15);

function eventHandler(PhpCore\Event\Args $p,$target){
    var_dump("eventHandler",$p,$target);
}


$double = function($a) {
    return $a * 2;
};


PhpCore\Annotation::classAnnotations($product);
PhpCore\Annotation::methodAnnotations($product,'save');
PhpCore\Annotation::propertyAnnotations($product,'saveEvent');