<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/20/11
 * Time: 5:01 PM
 */
 
set_include_path(implode(PATH_SEPARATOR, array(
	get_include_path(),
    realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'library')
)));

include_once "PhpCore\\AutoLoader.php";
$loader = PhpCore\AutoLoader::singleton(true);
$loader->registerNamespace( new PhpCore\AutoLoaderParam( 'myLib',realpath(dirname(__FILE__) )));

$app = new PhpCore\Hmvc\Startup();
$app->addModule("home");

