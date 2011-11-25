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
        $paths = $this->getPathsInfo();
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

    function matcher(\PhpCore\Request\Base $request)
    {
        $paths = $this->getPathsInfo();
        $rqString = $request->getUrlString();
        $rsu = array();
        foreach ($paths as $k => $it) {
            if ($it === null) {
                $p = strpos($rqString,$k);
                if($p===false)
                    return -1;
                $rqString = substr($rqString, $p);
            }

            
        }
    }

    private $pathsInfo = null;

    function getPathsInfo()
    {
        if ($this->pathsInfo == null) {
            $p = $this->pattern;

            $bLen = strlen("<:");
            $eLen = strlen(">");
            $this->pathsInfo = array();

            while ($x = strpos($p, "<:")) {
                $pt = substr($p, 0, $x);
                if ($pt)
                    $this->pathsInfo[$pt] = null;
                $e = strpos($p, ">", $x);
                $key = substr($p, $k = $x + $bLen, $e - $k);
                $this->pathsInfo[$key] = $this->getRequirement($key);
                $p = substr($p, $e + $eLen);
            }
            if ($p)
                $this->pathsInfo[$p] = null;
        }
        return $this->pathsInfo;
    }
}
