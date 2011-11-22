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

    static private $routes = array();

    private $modules = array();

    protected function addModule(Startup $module)
    {
        $moduleName = get_class($module);
        if (isset($this->modules[$moduleName]))
            throw new Exception\DuplicateModule("registered module #" . $moduleName);

        $this->modules[get_class($module)] = $module;
    }

    public function doRegisterModule()
    {
        $methods = $this->getMethodsFromTagName("startup");
        foreach ($methods as $mt) {
            $mt->invoke($this);
        }
        foreach($this->modules as $module)
            $module->doRegisterModule();
    }

    public function doRegisterRoute(){
        
    }
}
