<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 11/24/11
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

namespace PhpCore\Route;
class Match
{
    private $route;

    function __construct(Base $route, \PhpCore\Request\Base $request)
    {
        $this->route = $route;
        $this->request = $request;

        //        $routes = explode("/", $route->getPattern());
        //        $paths = $request->getPaths();
        //        var_dump($paths,$routes);
    }

    private $routePath;

    function getRoutePath()
    {
        if ($this->routePath == null) {
            $this->routePath = array();
            var_dump($this->route->getPattern());
            foreach (explode("/", $this->route->getPattern()) as $it) {
                if (!empty($it)) {
                    if (strpos($it, ":") === 0) {
                        $k = substr($it, 1);
                        $this->routePath[$k] = $this->route->getRequirement($k);
                    } else {
                        $this->routePath[$it] = null;
                    }
                }
            }
        }
        return $this->routePath;
    }

    function equal()
    {
        echo "----\n";
        $rtPath = $this->getRoutePath();
        var_dump($rtPath);

        $rqPath = $this->request->getPaths();
        var_dump($rqPath);
        if (count($rqPath) != count($rtPath)) return false;


        return true;
    }
}
