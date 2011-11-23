<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/21/11
 * Time: 10:51 PM
 */

namespace app2\mods\www;
class Startup extends \PhpCore\Module\Startup{
    function registerRoute(\PhpCore\Route\Collection &$route ){
        $route->addRoute("/app2/:newsTypeId");
        $route->addRoute("/app2/read/:newsId");
    }

}
