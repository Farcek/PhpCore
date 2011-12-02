<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/20/11
 * Time: 5:01 PM
 */
//$str = 'foobar_action2008.html';
//
//preg_match('/(\w+)_action(\w+)(\d+)/', $str, $matches);

/* This also works in PHP 5.2.2 (PCRE 7.0) and later, however
 * the above form is recommended for backwards compatibility */
// preg_match('/(?<name>\w+): (?<digit>\d+)/', $str, $matches);

//echo "<pre>".print_r($matches,true)."</pre>";
//
//
//die;

set_include_path(implode(PATH_SEPARATOR, array(
                                              get_include_path(),
                                              realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'library')
                                         )));

include_once "PhpCore\\AutoLoader.php";
$loader = PhpCore\AutoLoader::singleton(true);
$loader->registerNamespace(new PhpCore\AutoLoaderParam('myLib', realpath(dirname(__FILE__))));

$loader->registerNamespace(new PhpCore\AutoLoaderParam('app', realpath(dirname(__FILE__) . "/../")));
$loader->registerNamespace(new PhpCore\AutoLoaderParam('app2', realpath(dirname(__FILE__) . "/../")));
$loader->registerNamespace(new PhpCore\AutoLoaderParam('Zend', realpath(dirname(__FILE__) . "/../../library/Vendor/zend/library")));
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
                ->setDefaults(array("id" => 45, "action" => "reader"))
                ->setRequirements(array("id" => "d"));
        $this->addRoutes($route);

        $route->matcher("/news/read?page=1&cate=1");
        //--
        //        $route->setPattern("/comment/[action]/[id]")
        //                ->setDefaults(array("id"=>45,"action"=>"reader"))
        //                ->setRequirements(array("id"=>"d"));
        //        $this->addRoutes($route);
        //
        //        $route->matcher("/news/read?page=1&cate=1");
    }
}

echo"<pre>";

$rq = new \PhpCore\Request\Base();
$rq->setUrlString("1mn/sound_archive/read32.xml?str=hello&pass=43");
///news/list/tab/top5?page=29




$route = new PhpCore\Route\Base();
$route->setPattern("/<:lang>/sound_<:controller>/<:action>:<:id>.<:format>;")
        ->setDefaults(array("action" => "reader","id" => 45,"format"=>'html'))
        ->setRequirements(array(
                               "id" => "/d",
                               "action" => array('reader', 'write', 'select')
                          ));

$route->getPartsInfo();





echo "----------------------\n";

$route->matcher($rq);


//$c = new wp();
//
//$c->setup();
//
//var_dump($c);
echo "</pre>";