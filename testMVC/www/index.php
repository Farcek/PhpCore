<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/20/11
 * Time: 5:01 PM
 */

set_include_path(implode(PATH_SEPARATOR, array(
                                              get_include_path(),
                                              realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'library')
                                         )));

include_once "PhpCore\\AutoLoader.php";
$loader = PhpCore\AutoLoader::singleton(true);
$loader->registerNamespace(new PhpCore\AutoLoaderParam('myLib', realpath(dirname(__FILE__))));

$loader->registerNamespace(new PhpCore\AutoLoaderParam('app', realpath(dirname(__FILE__) . "/../")));
$loader->registerNamespace(new PhpCore\AutoLoaderParam('app2', realpath(dirname(__FILE__) . "/../")));
//var_dump($loader->getRegisterNamespace());


class wp extends \PhpCore\Module\Startup
{
    /**
     * @startup
     * @return void
     */
    function registerModule()
    {
        app\member\Startup::$ss;
        $this->addModule(new \app\member\Startup());
        $this->addModule(new app\member\Startup);
    }
}

$c = new wp();
$c->registerModule();