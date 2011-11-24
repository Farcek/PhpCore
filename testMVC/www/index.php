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
    function registerModule()
    {
        $this->addModule(new app\member\Startup());
        $this->addModule(new app\www\Startup());
        $this->addModule(new app2\mods\www\Startup());
    }

    function registerRoute()
    {
        $route = new PhpCore\Route\Base();
        $route->setPattern("/[controller]/[action]/[id]")
                ->setDefaults(array("id"=>45,"action"=>"reader"))
                ->setRequirements(array("id"=>"d"));
        $this->addRoutes($route);
        
        $route->matcher("/news/read?page=1&cate=1");
    }
}

$rq = new \PhpCore\Request\Base();
$rq->setBaseUrl("/PhpCore/testMVC/www/index.php");
$r = $rq->getPaths();
var_dump($rq->GETParam());

//$c = new wp();
//
//$c->setup();
//
//var_dump($c);
