<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/3/11
 * Time: 10:54 PM
 */
 
include "init.php";


echo "------------------ Class\n";
$cls = new myLib\Child();

$c = PhpCore\DockBlock::ClassParser(new ReflectionClass($cls));

var_dump($c);

echo "------------------ Method\n";
$cls = new myLib\Child();

$c = PhpCore\DockBlock::MethodParser(new ReflectionMethod($cls,'ZaluuNas'));

var_dump($c);

