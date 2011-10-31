<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 10/30/11
 * Time: 9:33 PM
 */
namespace PhpCore;
class Event {
    private static $eventList = array();
    protected $name;
    function __construct($name){
        if(! isset(Event::$eventList[$name]))
            Event::$eventList[$this->name = $name] = array();
    }

    function fire($sender,$param = null){
        $p = new Event\Args($sender,(array)$param);
        foreach(Event::$eventList[$p->evetName = $this->name] as $name=>$it){
            call_user_func($it['handler'], $p ,$it['target']);
            if($p->cancel) break;
        }
    }
    function addListeners($handler,$target = null){
        Event::$eventList[$this->name][] = array('handler'=>$handler,'target'=>$target);
    }
}
