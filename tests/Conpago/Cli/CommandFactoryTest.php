<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 16.10.15
     * Time: 22:20
     */

    namespace Conpago\Cli;

use Conpago\Cli\Contract\CommandHelp;
use Conpago\Cli\Contract\ICommand;

class CommandFactoryTest extends \PHPUnit_Framework_TestCase
    {

        public function test_GetCommandWillReturnNullForEmptyCommandList()
        {
            $command_factory = new CommandFactory([]);
            $cmd = $command_factory->getCommand('dummy');
            $this->assertNull($cmd);
        }

        public function test_GetCommandWillReturnCommandInstance()
        {
            $cmd_mock = $this->createMock(ICommand::class);
            $command_factory = new CommandFactory(['cmd_name' => $cmd_mock]);
            $cmd = $command_factory->getCommand('cmd_name');
            $this->assertEquals($cmd_mock, $cmd);
        }

        public function test_GetCommandWillReturnNullForNotExistingCommand()
        {
            $cmd_mock = $this->createMock(ICommand::class);
            $command_factory = new CommandFactory(['cmd_name' => $cmd_mock]);
            $cmd = $command_factory->getCommand('dummy');
            $this->assertNull($cmd);
        }

        public function test_GetCommandsDescWillReturnEmptyArrayForEmptyCommandList()
        {
            $command_factory = new CommandFactory([]);
            $desc = $command_factory->getCommandsDesc();
            $this->assertEquals(0, count($desc));
        }

        public function test_GetCommandsDescWillReturnArrayWithCommandNameAndDesc()
        {
            $cmd_mock = $this->createMock(ICommand::class);
            $cmd_mock->method('getDescription')->willReturn('Desc');
            $command_factory = new CommandFactory(['cmd_name' => $cmd_mock]);
            $desc = $command_factory->getCommandsDesc();
            $this->assertEquals([new CommandHelp('cmd_name', 'Desc')], $desc);
        }

        public function test_GetCommandsDescWillReturnArrayWithMultipleCommandNameAndDesc()
        {
            $cmd_mock = $this->createMock(ICommand::class);
            $cmd_mock->method('getDescription')->willReturn('Desc');
            $cmd_mock2 = $this->createMock(ICommand::class);
            $cmd_mock2->method('getDescription')->willReturn('Desc2');
            $command_factory = new CommandFactory(['cmd_name' => $cmd_mock, 'cmd_name2' => $cmd_mock2]);
            $desc = $command_factory->getCommandsDesc();
            $this->assertEquals([new CommandHelp('cmd_name', 'Desc'), new CommandHelp('cmd_name2', 'Desc2')], $desc);
        }
    }
