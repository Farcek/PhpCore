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
        $this->addModule(new app\member\Startup());
        $this->addModule(new app\www\Startup());
    }
    /**
     * @startup
     * @return void
     */
    function app2register()
    {
        $this->addModule(new app2\mods\www\Startup());
    }

    function registerRoute(PhpCore\Route\Collection &$route ){
        var_dump("run registerRoute");
        $route->addRoute("/news/:newsTypeId");
        $route->addRoute("/news/read/:newsId");
    }

    
}

$c = new wp();

$c->doRegisterModule();
$c->setRouteCollection(new PhpCore\Route\Collection());
$c->doRegisterRoute();
var_dump($c);
var_dump($c->getRouteCollection());