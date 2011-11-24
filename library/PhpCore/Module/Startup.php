<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/21/11
 * Time: 10:41 PM
 */

namespace PhpCore\Module;
abstract class Startup extends \PhpCore\Object
{
    function __construct()
    {

    }

    private $modules = array();
    private $routes = array();

    protected function addModule(\PhpCore\Module\Startup $module)
    {
        $moduleName = get_class($module);
        if (isset($this->modules[$moduleName]))
            throw new \PhpCore\Module\Exception\DuplicateModule("registered module#" . $moduleName);
        $this->modules[$moduleName] = $module;
    }

    protected function addRoutes(\PhpCore\Route\Base $route)
    {
        $key = $route->getKey();
        if (isset($this->routes[$key]))
            throw new \PhpCore\Route\Exception\DuplicateRoute ("registered routeKey#" . $key);
        $this->routes[$key] = $route;
    }

    public function getModules()
    {
        return $this->modules;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function setup()
    {
        $this->registerModule();
        $this->registerRoute();
        foreach ($this->modules as $module) {
            var_dump($module);
            $module->setup();
        }
    }


    function registerModule()
    {

    }

    function registerRoute()
    {

    }
}
