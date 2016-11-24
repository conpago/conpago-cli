<?php

    /**
     * Created by PhpStorm.
     * User: bgolek
     * Date: 2015-10-09
     * Time: 14:28
     */

    namespace Conpago\Cli;

use Conpago\Cli\Application;

class ApplicationFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
         * @return Application
         */
        public function testCreateApplication_willReturnApplication()
        {
            $fac = new ApplicationFactory();
            $this->assertEquals(Application::class, get_class($fac->createApplication()));
        }
}
