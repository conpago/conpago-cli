<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-09
	 * Time: 14:29
	 */

	namespace Conpago\Cli;


	use PHPUnit_Framework_MockObject_MockObject;

	class ApplicationTest extends \PHPUnit_Framework_TestCase {

		/**
		 * @var PHPUnit_Framework_MockObject_MockObject
		 */
		protected $fac;
		/**
		 * @var PHPUnit_Framework_MockObject_MockObject
		 */
		protected $output;
		/**
		 * @var Application
		 */
		protected $app;

		protected function setUp()
		{
			$this->fac = $this->getMock('Conpago\Cli\ICommandFactory');
			$this->output = $this->getMock('Conpago\Cli\IOutput');
			$this->app = new Application($this->output, $this->fac);
		}

		public function testRunWithoutArgs_willPrintHelp()
		{
			$this->expectHelp();
			$this->doTest([]);
		}

		public function testRunWithHelpOption_willPrintHelp()
		{
			$this->expectHelp();
			$this->doTest(['--help']);
		}

		public function testRunWithHelpOptionAndNotExistingCommandName_willPrintCommandNotFoundAndHelp()
		{
			$command_name = 'command_name';
			$this->expectCommandNotFoundAndHelp($command_name);
			$this->doTest(['--help', 'command_name']);
		}

		public function testRunWithHOption_willPrintHelp()
		{
			$this->expectHelp();
			$this->doTest(['-h']);
		}

		public function testRunWithHOptionAndNotExistingCommandName_willPrintCommandNotFoundAndHelp()
		{
			$command_name = 'command_name';
			$this->expectCommandNotFoundAndHelp($command_name);
			$this->doTest(['-h', 'command_name']);
		}

		public function testRunWithHelpOptionAndCommandName_willPrintCommandHelp()
		{
			$command_name = 'command_name';
			$this->expectCommandHelp($command_name);
			$this->doTest(['--help', 'command_name']);
		}

		public function testRunWithHOptionAndCommandName_willPrintCommandHelp()
		{
			$command_name = 'command_name';
			$this->expectCommandHelp($command_name);
			$this->doTest(['-h', 'command_name']);
		}

		public function testRunWithVersionOption_willPrintHelp()
		{
			$this->expectVersion();
			$this->doTest(['--version']);
		}

		public function testRunWithExistingCommandName_willPrintCommandNotFoundAndHelp()
		{
			$command_name = 'command_name';
			$this->expectCommandNotFoundAndHelp($command_name);
			$this->doTest(['command_name']);
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

		private function doTest(array $args){
			$this->app->run($args);
		}

		function expectHelp(){
			$this->fac->method('getCommandsDesc')->willReturn(["command1" => "command1 desc"]);
			$this->fac->method('getCommandHelp')->willReturn(null);
			$this->output->expects($this->exactly(13))
					->method('writeLine')
					->withConsecutive(
							['Conpago %s by %s', '0.0.1-alpha', 'Bartosz Gołek'],
							[null, null],
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

		function expectVersion(){
			$this->output->expects($this->exactly(2))
					->method('writeLine')
					->withConsecutive(
							['Conpago %s by %s', '0.0.1-alpha', 'Bartosz Gołek'],
							[null, null]
					);
		}

		private function expectCommandNotFoundAndHelp($command_name)
		{
			$this->fac->method('getCommandsDesc')->willReturn(["command1" => "command1 desc"]);
			$this->output->expects($this->exactly(15))
					->method('writeLine')
					->withConsecutive(
							['Conpago %s by %s', '0.0.1-alpha', 'Bartosz Gołek'],
							[null, null],
							['Could not find command \'%s\'!', $command_name],
							[null, null],
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

		private function expectCommandHelp($command_name)
		{
			$this->fac->method('getCommandHelp')->willReturn("command1 help");
			$this->output->expects($this->exactly(3))
					->method('writeLine')
					->withConsecutive(
							['Conpago %s by %s', '0.0.1-alpha', 'Bartosz Gołek'],
							[null, null],
							['command1 help', null]);
		}

		private function expectCommandRun($command_name)
		{
			$command = $this->getMock('Conpago\Cli\ICommand');
			$command->expects($this->once())->method('run');
			$this->fac->method('getCommand')->willReturn($command);
		}

		private function expectCommandRunWithArgs($string, $args)
		{
			$command = $this->getMock('Conpago\Cli\ICommand');
			$command->expects($this->once())->method('run')->with($this->equalTo($args));
			$this->fac->method('getCommand')->willReturn($command);
		}
	}