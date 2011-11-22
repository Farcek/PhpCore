<?php
/**
 * Created by Farcek@gmail.com.
 * User: Farcek
 * Date: 11/21/11
 * Time: 10:50 PM
 */

namespace app\member;
class Startup extends \PhpCore\Module\Startup{
    /**
     * @startup
     * @return void
     */
    function registerModule()
    {
        $this->addModule(new modules\Startup());
    }
}
