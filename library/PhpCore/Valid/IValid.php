<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/19/11
 * Time: 2:31 PM
 */

namespace PhpCore\Valid;
interface IValid {
    /**
     * @abstract
     * @param $value string
     * @return bool
     */
    public function valid($value);
}
