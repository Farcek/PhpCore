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

    function matcher1(\PhpCore\Request\Base $request)
    {
        $paths = $this->getPartsInfo();
        $rqString = $request->getUrlString();
        var_dump($rqString . "\n=========================\n");
        foreach ($paths as $k => $it) {
            if ($it === null) {
                $n = strlen($k);
                $st = substr($rqString, 0, $n);

                if ($k !== $st)
                    return -1;
                $rqString = substr($rqString, $n);
            } elseif (is_array($it)) {

            } elseif (is_string($it)) {

            }
            var_dump($rqString);
            die;
        }
    }

    function matcher2(\PhpCore\Request\Base $request)
    {
        $paths = $this->getPartsInfo();
        var_dump($paths);
        $rqString = $request->getUrlString();
        var_dump($rqString);
        $rsu = array();
        foreach ($paths as $k => $it) {
            if ($it === null) {
                $p = strpos($rqString, $k);
                if ($p === false)
                    return -1;
                $rqString = substr($rqString, $p);
            }


        }
    }

    function matcherOk(\PhpCore\Request\Base $request)
    {
        $parts = $this->getPartsInfo();
        var_dump($parts);
        $rqString = $request->getUrlString();
        var_dump($rqString);
        $urlPosition = 0;
        $partIndex = 0;
        $maxPosition = strlen($rqString);


        $partNames = array_keys($parts);
        $values = array();
        $rank = 0;
        while ($urlPosition < $maxPosition && $partName = current($partNames)) {
            $part = $parts[$partName];

            if ($part === null) {
                $p = stripos($rqString, $partName, $urlPosition);
                if ($p === false) return false;

                $rank += 10;
                $urlPosition += strlen($partName);


            } else {
                $nextPartName = next($partNames);
                if ($nextPartName) {
                    $p = strpos($rqString, $nextPartName, $urlPosition);
                    if ($p === null) {
                        $v = substr($rqString, $urlPosition);
                    } elseif ($p == 0) {
                        $v = "";
                    } else {
                        $v = substr($rqString, $urlPosition, $p - $urlPosition);
                    }
                    $urlPosition += strlen($v) + strlen($nextPartName);
                } else {
                    $v = substr($rqString, $urlPosition);
                    $urlPosition += strlen($v);
                }
                $values[$partName] = $v;
            }
            var_dump($values);
            next($partNames);
        }
    }


    function matcher(\PhpCore\Request\Base $request)
    {
        $parts = $this->getPartsInfo();

        echo "<pre>" . print_r($parts, true) . "</pre>";
        echo "<pre>" . print_r($this->pattern, true) . "</pre>";
        $urlPosition = 0;
        $rqString = $request->getUrlString();
        echo "<pre>" . print_r($rqString, true) . "</pre>";

        //$rank = 0;

        $str = array();
        foreach ($parts as $part => $it) {
            var_dump("------------------", $part);
            echo "<pre>" . print_r($str, true) . "</pre>";
            if ($it === null) {
                $p = stripos($rqString, $part, $urlPosition);
                if ($p === false) {
                    break;
                }

                $str[] = substr($rqString, $urlPosition, $p - $urlPosition);
                $urlPosition = $p + strlen($part);
            }
        }
        $str[] = substr($rqString, $urlPosition);
        var_dump($str);
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
                if(empty($pt))
                    throw new \PhpCore\Route\Exception\PatternFormat("Check pattern #".$this->pattern);

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
