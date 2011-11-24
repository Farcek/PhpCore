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
    function __construct(Base $route, \PhpCore\Request\Base $request)
    {
        $routes = explode("/", $route->getPattern());
        


    }

    function equal()
    {
        return true;
    }
}
