<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/19/11
 * Time: 1:59 PM
 */

namespace PhpCore\Filter;
class Alnum implements IFilter{
    function __construct($allowSpace){
        
    }

    public function filter($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}
