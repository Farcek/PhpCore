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
    var_dump("----------","eventHandler", $p->evetName);
}
$double = function($a) {
    return $a * 2;
};
var_dump($double);

$cls = new ReflectionClass("myLib\Child");
$c = PhpCore\Annotation\DockBlock::Parser($cls->getMethod('send')->getDocComment());
var_dump($c);

$c = PhpCore\Annotation\DockBlock::MethodParser($cls->getMethod('baseMethod'));
var_dump($c,"---");
$c = PhpCore\Annotation\DockBlock::MethodParser($cls->getMethod('send'));
var_dump($c);



//PhpCore\Annotation::classAnnotations($product);
//PhpCore\Annotation::methodAnnotations($product,'save');
//PhpCore\Annotation::propertyAnnotations($product,'saveEvent');