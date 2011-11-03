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
class Hohton {
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
}
