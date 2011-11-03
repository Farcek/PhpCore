<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/3/11
 * Time: 4:15 PM
 */

namespace myLib;
/**
 * Hohton amitan
 *
 * buh torliin hunton amitan.
 * exp :
 *      Mori
 *      Nohoi
 * 
 * @hoiinTo 4
 */
class Hohton implements myInterface,myBaseInterface {
    /**
     * ene shorder desc
     * @var 3
     */
    private  $pro;
    /**
     * Nas
     *
     * Heden nastai esen
     * @var int
     * @default 20
     */
    var $nas;

    function gender(){

    }

    /**
     * @isNas 1
     * @return bool
     */
    function ZaluuNas(){
        return $this->nas < 3;
    }

    function baseMethod(){
        
    }

    function myInterfaceMBase()
    {
        // TODO: Implement myInterfaceMBase() method.
    }
}
