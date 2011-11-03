<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/4/11
 * Time: 12:42 AM
 */
namespace myLib;
/**
 * @classIntTag myChildInterfase
 */
interface myChildInterfase extends myBaseInterface{
    /**
     * @abstract myChildInterfase
     * @return myChildInterfase
     * @interfasetag myInterfaceMChild
     */
    function myInterfaceMChild();
}