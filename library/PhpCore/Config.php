<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 10/31/11
 * Time: 12:24 AM
 */

namespace PhpCore;
class Config extends Object implements \Iterator
{
    protected $_data;

    function __construct(array $initData = null)
    {
        if ($initData)
            $this->_data = $initData;
    }


    public function current()
    {
        return current($this->_data);
    }


    public function next()
    {
        return next($this->_data);
    }


    public function key()
    {
        return key($this->_data);
    }


    public function valid()
    {
        return $this->current() !== false;
    }

    public function rewind()
    {
        reset($this->_data);
    }

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->_data))
            $this->_data[$name] = $value;
        else {
            $cls = get_class($this);
            trigger_error("Undefined property: $cls::$name");
        }
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }
        $cls = get_class($this);
        trigger_error("Undefined property: $cls::$name");
    }


    public function __isset($name)
    {
        return isset($this->_data[$name]);
    }

    public function __unset($name)
    {
        unset($this->_data[$name]);
    }

}
