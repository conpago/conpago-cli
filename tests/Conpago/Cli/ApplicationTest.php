<?php
    /**
     * Created by PhpStorm.
     * User: bgolek
     * Date: 2015-10-09
     * Time: 14:29
     */

    namespace Conpago\Cli;

use Conpago\Cli\Contract\IApplicationPresenter;
use Conpago\Cli\Contract\ICommand;
use Conpago\Cli\Contract\ICommandFactory;
use PHPUnit_Framework_MockObject_MockObject;

    class ApplicationTest extends \PHPUnit_Framework_TestCase
    {

        /**
         * @var PHPUnit_Framework_MockObject_MockObject
         */
        protected $fac;
        /**
         * @var PHPUnit_Framework_MockObject_MockObject
         */
        protected $application_presenter;
        /**
         * @var Application
         */
        protected $app;

        protected function setUp()
        {
            $this->fac = $this->createMock(ICommandFactory::class);
            $this->application_presenter = $this->createMock(IApplicationPresenter::class);
            $this->app = new Application($this->application_presenter, $this->fac);
        }

        public function testRunWithoutArgs_willPrintHelp()
        {
            $this->expectVersion();
            $this->expectHelp();
            $this->doTest([]);
        }

        public function testRunWithHelpOption_willPrintHelp()
        {
            $this->expectVersion();
            $this->expectHelp();
            $this->doTest(['--help']);
        }

        public function testRunWithHelpOptionAndNotExistingCommandName_willPrintCommandNotFoundAndHelp()
        {
            $command_name = 'command_name';
            $this->expectVersion();
            $this->expectCommandNotFound($command_name);
            $this->expectHelp();
            $this->doTest(['--help', $command_name]);
        }

        public function testRunWithHOption_willPrintHelp()
        {
            $this->expectVersion();
            $this->expectHelp();
            $this->doTest(['-h']);
        }

        public function testRunWithHOptionAndNotExistingCommandName_willPrintCommandNotFoundAndHelp()
        {
            $command_name = 'command_name';
            $this->expectVersion();
            $this->expectCommandNotFound($command_name);
            $this->expectHelp();
            $this->doTest(['-h', $command_name]);
        }

        public function testRunWithHelpOptionAndCommandName_willPrintCommandHelp()
        {
            $this->expectVersion();
            $this->expectCommandHelp();
            $this->doTest(['--help', 'command_name']);
        }

        public function testRunWithVersionOption_willPrintHelp()
        {
            $this->expectVersion();
            $this->doTest(['--version']);
        }

        public function testRunWithExistingCommandName_willPrintCommandNotFoundAndHelp()
        {
            $command_name = 'command_name';
            $this->expectVersion();
            $this->expectCommandNotFound($command_name);
            $this->expectHelp();
            $this->doTest([$command_name]);
        }

        public function testRunWithCommandName_willRunCommand()
        {
            $this->expectCommandRun('command_name');
            $this->doTest(['command_name']);
        }

        public function testRunWithCommandNameAndArgs_willPassArgsCommand()
        {
            $this->expectCommandRunWithArgs('command_name', ['a', 'b']);
            $this->doTest(['command_name', 'a', 'b']);
        }

        private function doTest(array $args)
        {
            $this->app->run($args);
        }

        private function expectCommandRun($command_name)
        {
            $command = $this->createMock(ICommand::class);
            $command->expects($this->once())->method('run');
            $this->fac->method('getCommand')->willReturn($command);
        }

        private function expectCommandRunWithArgs($string, $args)
        {
            $command = $this->createMock(ICommand::class);
            $command->expects($this->once())->method('run')->with($this->equalTo($args));
            $this->fac->method('getCommand')->willReturn($command);
        }

        private function expectHelp()
        {
            $this->application_presenter
                    ->expects($this->once())
                    ->method("printHelp");
        }

        private function expectVersion()
        {
            $this->application_presenter
                    ->expects($this->once())
                    ->method("printVersion");
        }

        private function expectCommandNotFound($command_name)
        {
            $this->application_presenter
                    ->expects($this->once())
                    ->method("printCommandNotFound")
                    ->with($this->equalTo($command_name));
        }

        private function expectCommandHelp()
        {
            $command = $this->createMock(ICommand::class);
            $command->expects($this->once())->method("printHelp");
            $this->fac->method("getCommand")->willReturn($command);
        }
    }
