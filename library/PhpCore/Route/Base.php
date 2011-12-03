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

    function getPattern()
    {
        return $this->pattern;
    }

    function setDefaults(array $default)
    {
        return $this;
    }
    function getDefaults()
    {
        return array();
    }

    function getDefault($name)
    {
        return "";
    }

    function getDefaultRequirement()
    {
        return "/s";
    }

    private $requirements = array();

    function setRequirements(array $requirements)
    {
        $this->requirements = $requirements;
        return $this;
    }

    function getRequirement($key)
    {
        if (isset($this->requirements[$key]))
            return $this->requirements[$key];
        return $this->getDefaultRequirement();
    }


    function matcher(\PhpCore\Request\Base $request)
    {
        $paths = $this->getPartsInfo();
        $rqString = $request->getUrlString();

        //--------------------------------------------------
        $position = 0;
        $index = 0;
        $maxPosition = strlen($rqString);

        $splits = array();

        while (isset($paths[$index]) && $position < $maxPosition) {
            $part = $paths[$index++];
            $p = strpos($rqString, $part, $position);
            if ($p === false) {
                break;
            }
            if ($position > 0)
                $splits[] = substr($rqString, $position, $p - $position);
            $position = $p + strlen($part);
        }
        if ($position < $maxPosition) {
            $splits[] = substr($rqString, $position);
        }
        $rsu = array();
        $index = 0;
        foreach ($paths as $k => $it) {
            if (is_string($k)) {
                if(!isset($splits[$index])){
                    $request->setParam($k,$this->getDefault($k));
                    continue;
                }
                //$kk = $this->getRequirement($k);
                $v = $splits[$index++];
                if(empty($v)){
                    $request->setParam($k,$this->getDefault($k));
                    continue;
                }
                $rq = $this->getRequirement($k);
                if(is_string($rq) ){
                    if(preg_match($rq,$v))
                        $request->setParam($k,$v);
                    else
                        return false;
                }else if(is_array($rq)){
                    if(in_array($v,$rq))
                        $request->setParam($k,$v);
                    else return false;
                }

            }
        }
        
        echo "<pre>".print_r($rsu,true)."</pre>";

    }

    private $partsInfo = null;

    function getPartsInfo()
    {
        if ($this->partsInfo == null) {
            $p = $this->pattern;

            $bLen = strlen("<:");
            $eLen = strlen(">");
            $this->partsInfo = array();

            while (($x = strpos($p, "<:")) !== false) {
                $this->partsInfo[] = $pt = substr($p, 0, $x);
                if (empty($pt))
                    throw new \PhpCore\Route\Exception\PatternFormat("Check pattern #" . $this->pattern);

                $e = strpos($p, ">", $x);
                $key = substr($p, $k = $x + $bLen, $e - $k);
                $this->partsInfo[$key] = $this->getRequirement($key);
                $p = substr($p, $e + $eLen);

            }
            if ($p)
                $this->partsInfo[] = $p;
        }
        return $this->partsInfo;
    }
}

class patternItem
{
    var $type;
    var $v;
    var $index;

    function __construct($type, $v, $i)
    {
        $this->type = $type;
        $this->v = $v;
        $this->index = $i;
    }
}
