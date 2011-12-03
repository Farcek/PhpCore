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


    function matcher(\PhpCore\Request\Base $request)
    {
        $paths = $this->getPathsInfo();
        echo "<pre>" . print_r($this->pattern, true) . "</pre>";
        echo "<pre>" . print_r($paths, true) . "</pre>";

        $rqString = $request->getUrlString();
        echo "<pre>" . print_r($rqString, true) . "</pre>";
        $rsu = array();

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
            echo "<pre>" . print_r("$p - $position - $maxPosition - $index", true) . "</pre>";

        }
        if ($position < $maxPosition) {
            $splits[] = substr($rqString, $position);
        }

        var_dump($splits);


        $rank = 0;
        $oldIndex = -1;
        while ($it = current($paths)) {
            $k = key($paths);
            if (is_int($k)) {
                $p = strpos($rqString, $it);
                if ($p === false) {
                    return -1;
                }
                $rank++;
                $rqString = substr($rqString, $p + strlen($it));
                $oldIndex = $k;
            } elseif (is_string($k)) {
                if (isset($paths[$oldIndex + 1])) {
                    $nextKey = $paths[$oldIndex + 1];
                    $p = strpos($rqString, $nextKey);
                    if ($p === false) {
                        return -1;
                    }
                    $rank++;
                    $rsu[$k] = $v = substr($rqString, 0, $p);

                    $rqString = substr($rqString, $p);
                } else {
                    $rsu[$k] = $rqString;
                    $rqString = "";
                }
            }

            next($paths);
        }
        echo "<pre>" . print_r($rsu, true) . "</pre>";
        return $rank;

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
                //if ($pt)
                $this->pathsInfo[] = $pt;
                $e = strpos($p, ">", $x);
                $key = substr($p, $k = $x + $bLen, $e - $k);
                $this->pathsInfo[$key] = $this->getRequirement($key);
                $p = substr($p, $e + $eLen);
            }
            if ($p)
                $this->pathsInfo[] = $p;
        }
        return $this->pathsInfo;
    }
}
