<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/3/11
 * Time: 4:19 PM
 */

namespace myLib;
/**
 * huuhed class bna
 *
 * @isChild true
 */
class Child extends Hohton implements myChildInterfase{

    /**
     * zaluu child checker
     * 
     * @return void
     * @status childClass
     * @child 11
     * @child 22
     * @isNas child =1
     */
    function ZaluuNas(){
        return parent::ZaluuNas();
    }

    function myInterfaceMBase()
    {
        // TODO: Implement myInterfaceMBase() method.
    }

    function myInterfaceMChild()
    {
        // TODO: Implement myInterfaceMChild() method.
    }
}