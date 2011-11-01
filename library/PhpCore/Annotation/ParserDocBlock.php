<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/1/11
 * Time: 10:24 AM
 */

namespace PhpCore\Annotation;
class ParserDocBlock
{
    function __construct($text)
    {
        $dd = explode("\n", $text);
        $lines = array();
        for ($i = 1; $i < count($dd) - 1; $i++) {
            $lines[] = substr(trim($dd[$i]), 2);
        }

        $tags = array();
        $descLines = array();

        foreach($lines as $it){
            if (stripos($it, "@") === 0) {
                $tags[] = array($it) ;
            } else if (empty($tags))
                $descLines[] = $it;
            else if(!empty($tags)){
                $tags[count($tags)-1][] = $it;
            }else throw new Exception("Dock block standart");
        }

        

        var_dump($tags);
        var_dump($descLines);
    }
}
