<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 10/31/11
 * Time: 10:36 PM
 */

namespace PhpCore;
class Annotation {
    static function classAnnotations($cls){
        $c = new \ReflectionClass($cls);
        $db = Annotation\DockBlock::Parser($c->getDocComment());

        var_dump($db);
    }
    static function methodAnnotations($cls){

    }
    static function propertyAnnotations($cls){

    }
}
