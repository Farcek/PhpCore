<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/2/11
 * Time: 2:10 AM
 */

namespace PhpCore\Annotation;
class DockBlock
{
    protected $shortDesc;
    protected $longDesc;
    protected $tags;
    function __construct($shortDesc,$longDesc,array $tags){
        $this->shortDesc = $shortDesc;
        $this->longDesc= $longDesc;
        $this->tags= $tags;
    }


    /**
     * @static
     * @throws Exception
     * @param string $text
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
            };
        }


        $shortDesc = "";
        $longDesc = "";
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

        return new DockBlock(trim($shortDesc),trim($longDesc),$tags);
    }
}
