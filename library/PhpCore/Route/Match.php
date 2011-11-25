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





    function match()
    {



        return true;
    }
}
