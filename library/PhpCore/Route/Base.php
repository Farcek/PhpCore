<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/23/11
 * Time: 3:30 PM
 */

namespace PhpCore\Route;
class Base
{
    

    function getKey()
    {
        return $this->pattern;
    }

    

    private $pattern;

    /**
     * @param $pattern string
     * @return Base
     */
    function setPattern($pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }
    function getPattern(){
        return $this->pattern;
    }

    function setDefaults(array $default){
        return $this;
    }
    function setRequirements(array $requirements){
        return $this;
    }

    function matcher($request){
        $m = new Match($this->pattern,$request);
        return $m->equal();
    }

}
