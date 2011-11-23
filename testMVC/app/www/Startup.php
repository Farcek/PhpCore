<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/21/11
 * Time: 10:50 PM
 */

namespace app\www;
class Startup extends \PhpCore\Module\Startup{
function registerRoute(\PhpCore\Route\Collection &$route ){
        $route->addRoute("/www/:newsTypeId");
        $route->addRoute("/www/read/:newsId");
    }
}
