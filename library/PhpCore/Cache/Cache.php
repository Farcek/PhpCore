<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/2/11
 * Time: 2:34 AM
 */
 
namespace PhpCore\Cache;
interface Cache
{
    function get($id);
    function has($id);
    function save($id, $data);
    function delete($id);
}