<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/2/11
 * Time: 2:10 AM
 */

namespace PhpCore;
final class DockBlock extends Object
{
    protected $shortDesc;
    protected $longDesc;
    protected $tags = array();

    /**
     * @static
     * @param $text
     * @return DockBlock
     */
    static function Parser($text)
    {
        $dd = explode("\n", $text);
        $lines = array();
        for ($i = 1; $i < count($dd) - 1; $i++) {
            $lines[] = substr(trim($dd[$i]), 2);
        }

        $tags = array();
        $descLines = array();
        foreach ($lines as $it) {
            if (stripos($it, "@") === 0) {
                $tags[] = $it;
            } else if (empty($tags))
                $descLines[] = $it;
            else if (!empty($tags)) {
                $tags[count($tags) - 1] .= " $it";
            }
        }

        $shortDesc = null;
        $longDesc = null;
        $cur = &$shortDesc;
        foreach ($descLines as $k => $it) {
            if ($it || $longDesc) {
                $cur .= "\n $it";
                continue;
            }
            if ($shortDesc && $it === false) {
                $cur = &$longDesc;
            }
        }
        return new DockBlock(
            array(
                 'shortDesc' => trim($shortDesc),
                 'longDesc' => trim($longDesc),
                 'tags' => $tags
            )
        );
    }


    static function ClassParser(\ReflectionClass $class)
    {


        $shortDesc = null;
        $longDesc = null;
        $tags = array();
        while ($class instanceof \ReflectionClass) {
            $tmp = self::Parser($class->getDocComment());
            if ($shortDesc == null && $tmp->shortDesc)
                $shortDesc = $tmp->shortDesc;
            if ($longDesc == null && $tmp->longDesc)
                $longDesc = $tmp->longDesc;
            foreach ($tmp->tags as $tag) {
                $tags[] = $tag;
            }
            $class = $class->getParentClass();
        }

        return new DockBlock(
            array(
                 'shortDesc' => $shortDesc,
                 'longDesc' => $longDesc,
                 'tags' => $tags
            )
        );
    }

    static function MethodParser(\ReflectionMethod $method)
    {
        $mts = array($method);
        $cls = $method->getDeclaringClass()->getParentClass();
        while ($cls && $cls->hasMethod($method->getName())) {
            $mts[] = $cls->getMethod($method->getName());
            $cls = $cls->getParentClass();
        }

        $cls->getInterfaces();
        
        $shortDesc = null;
        $longDesc = null;
        $tags = array();
        foreach ($mts as $it) {
            $tmp = self::Parser($it->getDocComment());
            if ($shortDesc == null && $tmp->shortDesc)
                $shortDesc = $tmp->shortDesc;

            if ($longDesc == null && $tmp->longDesc)
                $longDesc = $tmp->longDesc;

            foreach ($tmp->tags as $tag) {
                $tags[] = $tag;
            }
        }
        return new DockBlock(
            array(
                 'shortDesc' => $shortDesc,
                 'longDesc' => $longDesc,
                 'tags' => $tags
            )
        );
    }
}
