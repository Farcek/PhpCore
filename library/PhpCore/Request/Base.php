<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 11/24/11
 * Time: 5:06 PM
 * To change this template use File | Settings | File Templates.
 */

namespace PhpCore\Request;
final class Base
{
    function __construct()
    {

    }

    private $urlString;

    function setUrlString($urlString)
    {
        $baseUrl = $this->getBaseUrl();
        $urlString = $urlString[0] == "/" ? $urlString : "/" . $urlString;
        if (strpos($urlString, $baseUrl) === 0)
            $this->urlString = substr($urlString, strlen($baseUrl));
        else $this->urlString = $urlString;
        


        return $this;
    }

    function getUrlString()
    {
        if ($this->urlString == null)
            $this->setUrlString($_SERVER["REQUEST_URI"]);
        return $this->urlString;
    }

//    private $paths;
//
//    function getPaths()
//    {
//        if ($this->paths == null) {
//            $urlString = $this->getUrlString();
//
//            $position = strpos($urlString, '?');
//
//            if ($position)
//                $urlString = substr($urlString, 0, $position);
//            $this->paths = array();
//            foreach (explode("/", $urlString) as $it)
//                if (!empty($it))
//                    $this->paths[] = $it;
//        }
//        return $this->paths;
//    }

    private $params;

    function getParams()
    {
        if ($this->params == null) {
            $this->params = array();
            foreach ($_REQUEST as $k => $v) {
                $this->params[$k] = $v;
            }
        }
        return $this->params;
    }

    function setParams(array $params)
    {
        foreach ((array)$params as $k => $it) {
            if (is_string($k))
                $this->setParam($k, $it);
        }
    }

    function setParam($name, $value)
    {
        if ($this->params == null)
            $this->params = array();
        $this->params[$name] = $value;
    }


    private $baseUrl = "";

    function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl[0] == "/" ? '' : '/' . $baseUrl;

        return $this;
    }

    function getBaseUrl()
    {
        return $this->baseUrl;
    }


}
