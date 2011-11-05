<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/2/11
 * Time: 2:10 AM
 */

namespace PhpCore;
final class DocBlock extends Object
{
    protected $shortDesc;
    protected $longDesc;
    protected $tags = array();

    


    /**
     * @static
     * @param $text
     * @return DocBlock
     */
    static function Parser($text)
    {
        $dd = explode("\n", $text);
        $lines = array();
        for ($i = 1; $i < count($dd) - 1; $i++) {
            $lines[] = substr(trim($dd[$i]), 2);
        }

        $tagValues = array();
        $descLines = array();
        foreach ($lines as $it) {
            if (stripos($it, "@") === 0) {
                $tagValues[] = $it;
            } else if (empty($tagValues))
                $descLines[] = $it;
            else if (!empty($tagValues)) {
                $tagValues[count($tagValues) - 1] .= " $it";
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
            if (/*$shortDesc && */$it === false) {
                $cur = &$longDesc;
            }
        }
        $tags = array();
        foreach($tagValues as $it){

            @list($tag,$value) = explode(" ",$it,2);
            $tags[]= new \PhpCore\DocBlock\Tag(array('name'=>substr( $tag,1),'value'=>$value));
        }
        return new DocBlock(
            array(
                 'shortDesc' => trim($shortDesc),
                 'longDesc' => trim($longDesc),
                 'tags' => $tags
            )
        );
    }


    private static function classMap(\ReflectionClass $class)
    {
        $list = array();
        while ($class instanceof \ReflectionClass) {
            $list[$class->getName()] = $class;
            foreach ($class->getInterfaces() as $cls) {
                $n = $cls->getName();
                if (isset($list[$n])) {
                    unset($list[$n]);
                }
                $list[$n] = $cls;
            }
            $class = $class->getParentClass();
        }
        return $list;
    }

    static function ClassParser(\ReflectionClass $class)
    {
        $shortDesc = null;
        $longDesc = null;
        $tags = array();
        foreach (self::classMap($class) as $cls) {
            $tmp = self::Parser($cls->getDocComment());
            if ($shortDesc == null && $tmp->shortDesc)
                $shortDesc = $tmp->shortDesc;
            if ($longDesc == null && $tmp->longDesc)
                $longDesc = $tmp->longDesc;
            foreach ($tmp->tags as $tag) {
                $tags[] = $tag;
            }
        }

        return new DocBlock(
            array(
                 'shortDesc' => $shortDesc,
                 'longDesc' => $longDesc,
                 'tags' => $tags
            )
        );
    }

    static function MethodParser(\ReflectionMethod $method)
    {
        $list = self::classMap($method->getDeclaringClass());
        $shortDesc = null;
        $longDesc = null;
        $tags = array();
        foreach ($list as $cls) {
            $methodName = $method->getName();
            if ($cls->hasMethod($methodName)){
                $mt = $cls->getMethod($methodName);
                $tmp = self::Parser($mt->getDocComment());
                if ($shortDesc == null && $tmp->shortDesc)
                    $shortDesc = $tmp->shortDesc;
                if ($longDesc == null && $tmp->longDesc)
                    $longDesc = $tmp->longDesc;
                foreach ($tmp->tags as $tag) {
                    $tags[] = $tag;
                }
            }
        }
        return new DocBlock(
            array(
                 'shortDesc' => $shortDesc,
                 'longDesc' => $longDesc,
                 'tags' => $tags
            )
        );
    }

    static function PropertyParser(\ReflectionProperty $property)
    {
        $list = self::classMap($property->getDeclaringClass());
        $shortDesc = null;
        $longDesc = null;
        $tags = array();
        foreach ($list as $cls) {
            $proName = $property->getName();
            if ($cls->hasProperty($proName)) {
                $tmp = self::Parser($cls->getProperty($proName)->getDocComment());
                if ($shortDesc == null && $tmp->shortDesc)
                    $shortDesc = $tmp->shortDesc;
                if ($longDesc == null && $tmp->longDesc)
                    $longDesc = $tmp->longDesc;
                foreach ($tmp->tags as $tag) {
                    $tags[] = $tag;
                }
            }
        }
        return new DocBlock(
            array(
                 'shortDesc' => $shortDesc,
                 'longDesc' => $longDesc,
                 'tags' => $tags
            )
        );
    }
}
