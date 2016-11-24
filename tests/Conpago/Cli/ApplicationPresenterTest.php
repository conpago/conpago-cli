<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 17.10.15
     * Time: 23:38
     */

    namespace Conpago\Cli;

use Conpago\Cli\Contract\CommandHelp;
use Conpago\Cli\Contract\IOutput;
use Symfony\Component\Finder\Shell\Command;

    class ApplicationPresenterTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        protected $output;
        /**
         * @var ApplicationPresenter
         */
        protected $application_presenter;

        protected function setUp()
        {
            $this->output                = $this->createMock(IOutput::class);
            $this->application_presenter = new ApplicationPresenter($this->output);
        }

        public function test_printHelp_willPrintHelp()
        {
            $this->expectHelp();
            $this->application_presenter->printHelp([new CommandHelp("command1", "command1 desc")]);
        }

        public function test_printVersion_willPrintVersion()
        {
            $this->expectVersion();
            $this->application_presenter->printVersion();
        }

        public function test_printCommandNotFound_willPrintCommandNotFound()
        {
            $this->expectCommandNotFound('command');
            $this->application_presenter->printCommandNotFound('command');
        }

        public function expectHelp()
        {
            $this->output->expects($this->exactly(11))
                         ->method('writeLine')
                         ->withConsecutive(
                                 ["Usage: conpago <command> [command_options]", null],
                                 [null, null],
                                 ["Commands:", null],
                                 [null, null],
                                 ["  %s %s.", "command1                 ", "command1 desc"],
                                 [null, null],
                                 ["Miscellaneous Options:", null],
                                 [null, null],
                                 ["  -h|--help                 Prints this usage information.", null],
                                 ["  -h|--help <command>       Prints detailed command usage information.", null],
                                 ["  --version                 Prints the version and exits.", null]
                         );
        }

        public function expectVersion()
        {
            $this->output->expects($this->exactly(2))
                         ->method('writeLine')
                         ->withConsecutive(
                                 ['Conpago %s by %s', '0.0.1-alpha', 'Bartosz Gołek'],
                                 [null, null]
                         );
        }

        private function expectCommandNotFound($command_name)
        {
            $this->output->expects($this->exactly(2))
                         ->method('writeLine')
                         ->withConsecutive(
                                 ['Could not find command \'%s\'!', $command_name],
                                 [null, null]
                         );
        }
    }
