<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/2/11
 * Time: 2:40 AM
 */

namespace PhpCore\Cache;
class FileCache implements Cache
{
    static public $tmpDir = "\tmp";


    function get($id)
    {
        return file_get_contents($this->getFilename($id));
    }

    function has($id)
    {
        return file_exists($this->getFilename($id));
    }

    function save($id, $data)
    {
        file_put_contents($this->getFilename($id), $data);
    }

    function delete($id)
    {
        unlink($this->getFilename($id));
    }

    private function getFilename($id)
    {
        return self::$tmpDir . DIRECTORY_SEPARATOR . $id;
    }
}
