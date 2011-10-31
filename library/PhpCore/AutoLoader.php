<?php
/**
 * Created by Farcek.
 * User: Farcek@gmail.com
 * Date: 10/30/11
 * Time: 7:04 PM
 */
namespace PhpCore;
class AutoLoader {
    function __construct(){
        $this->registerSystem();
    }
    private $namespaces = array();
    public function  registerNamespace(AutoLoaderParam $param){
        $this->namespaces[$param->namespace] = $param;
    }

    public function registerSystem(){
        spl_autoload_register(array($this, 'execute'));
    }
    public function unregisterSystem(){
        spl_autoload_register(array($this, 'execute'));
    }

    /**
     * @param string $className
     * @return bool
     */
    private function execute($className){
        foreach($this->namespaces as $it){
            if($this->loadClass($className,$it))
                return true;
        }
        return false;
    }

    private function loadClass($className,AutoLoaderParam $param){
        if (!empty($param->namespace) && strpos($className, $param->namespace.$param->namespaceSeparator) !== 0) {
            return false;
        }
        require_once ($param->path !== null ? $param->path . DIRECTORY_SEPARATOR : '')
               . str_replace($param->namespaceSeparator, DIRECTORY_SEPARATOR, $className)
               . $param->fileExtension;
        return true;
    }

    /**
     * @static
     * @param bool $registerPhpCore
     * @return AutoLoader
     */
    public static function singleton($registerPhpCore = false){
        if (self::$instance == null) {
            $clsName = __CLASS__;
            self::$instance = new $clsName;
            if($registerPhpCore)
                self::$instance->registerNamespace( new AutoLoaderParam("PhpCore"));
        }
        return self::$instance;
    }
    /**
     * @var AutoLoader
     */
    private static $instance;

}

class AutoLoaderParam{
    function __construct($namespace,$path = null){
        $this->namespace = $namespace;
        $this->path = $path;
    }
    public $namespace;
    public $path;
    public $fileExtension = ".php";
    public $namespaceSeparator="\\";
}

