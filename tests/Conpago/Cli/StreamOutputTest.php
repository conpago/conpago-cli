<?php
    /**
     * Created by PhpStorm.
     * User: bgolek
     * Date: 2015-10-09
     * Time: 14:48
     */

    namespace Conpago\Cli;

class StreamOutputTest extends \PHPUnit_Framework_TestCase
{

    public function testWrite_willEchoData()
    {
        $o = fopen('php://memory', 'w');
        $out = new StreamOutput($o);
        $out->write("echo data");
        $this->assertStreamEquals("echo data", $o);
    }

    public function testWrite_willEchoDataWithArgs()
    {
        $o = fopen('php://memory', 'w');
        $out = new StreamOutput($o);
        $out->write("echo data %s", "abc");
        $this->assertStreamEquals("echo data abc", $o);
    }

    public function testWrite_willEchoNothing()
    {
        $o = fopen('php://memory', 'w');
        $out = new StreamOutput($o);
        $out->write();
        $this->assertStreamEquals("", $o);
    }

    public function testWriteLine_willEchoData()
    {
        $o = fopen('php://memory', 'w');
        $out = new StreamOutput($o);
        $out->writeLine("echo data");
        $this->assertStreamEquals("echo data".PHP_EOL, $o);
    }

    public function testWriteLine_willEchoDataWithArgs()
    {
        $o = fopen('php://memory', 'w');
        $out = new StreamOutput($o);
        $out->writeLine("echo data %s", "abc");
        $this->assertStreamEquals("echo data abc".PHP_EOL, $o);
    }

    public function testWriteLine_willEchoEmptyLine()
    {
        $o = fopen('php://memory', 'w');
        $out = new StreamOutput($o);
        $out->writeLine();
        $this->assertStreamEquals(PHP_EOL, $o);
    }

    protected function assertStreamEquals($expected, $stream)
    {
        fseek($stream, 0);
        $this->assertEquals($expected, fread($stream, 8192));
    }
}
