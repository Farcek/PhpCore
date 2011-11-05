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
class Child extends Hohton implements myChildInterfase,myInterface1{

    /**
     *
     * pro long desc
     * @var 1
     */
    var $pro;

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

    /**
     * @tag1 void
     * @tag2 void
     */
    function myInterfaceMBase()
    {
        // TODO: Implement myInterfaceMBase() method.
    }

    /**
     * @return void
     * @sanaa
     */
    function myInterfaceMChild()
    {
        // TODO: Implement myInterfaceMChild() method.
    }
}
