<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 10/31/11
 * Time: 1:17 AM
 */

namespace PhpCore\Event;
class Args
{
    public $param,$sender,$cancel = false;
    public $evetName;
    function __construct($sender,array $param)
    {
        //$this->hash = spl_object_hash($this);
        //var_dump($this->hash,$param);
        
        $this->param = $param;
        $this->sender = $sender;
    }
}
