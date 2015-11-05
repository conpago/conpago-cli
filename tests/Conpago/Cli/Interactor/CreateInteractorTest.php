<?php

	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 16.10.15
	 * Time: 23:10
	 */

	namespace Conpago\Cli\Interactor;


	use Conpago\Cli\Interactor\Contract\CreateInteractorContext;
	use Conpago\File\Path;

	class CreateInteractorTest extends \PHPUnit_Framework_TestCase {

		/**
		 * @var \PHPUnit_Framework_MockObject_MockObject
		 */
		protected $presenter;
		/**
		 * @var \PHPUnit_Framework_MockObject_MockObject
		 */
		protected $contextBuilder;
		/**
		 * @var CreateInteractor
		 */
		protected $createInteractor;
		/**
		 * @var \PHPUnit_Framework_MockObject_MockObject
		 */
		protected $fileListBuilder;
		/**
		 * @var \PHPUnit_Framework_MockObject_MockObject
		 */
		protected $fileSystem;
		/**
		 * @var \PHPUnit_Framework_MockObject_MockObject
		 */
		protected $templateProcessor;

		function test_PrinHelp_willPrintHelp()
		{
			$this->presenter->expects($this->once())
					->method("printHelp");
			$this->createInteractor->printHelp();
		}

		private function expectedDescription()
		{
			return "Generate interactor with interfaces and adapters stubs. ".
			       "It also generate tests stubs.".PHP_EOL;
		}

		function test_GetDescriptionWillReturnDescription()
		{
			$description = $this->createInteractor->getDescription();
			$this->assertEquals($this->expectedDescription(), $description);
		}

		function test_CommandRunWithMissingParameters_willPrintMissingParametersAndHelp()
		{
			$this->presenter->expects($this->once())
			                ->method("printMissingParameter");
			$this->presenter->expects($this->once())
			                ->method("printHelp");
			$this->createInteractor->run([]);
		}

		function test_WillCallContextBuilder()
		{
			$context = new CreateInteractorContext();
			$this->contextBuilder->expects($this->once())
			                     ->method("build")
			                     ->willReturn($context);

			$this->fileListBuilder
					->expects($this->any())
					->method("build")
					->willReturn([]);

			$this->createInteractor->run(["CreateUser"]);
		}

		function test_WillPassContextToTemplateFileListBuilder()
		{
			$context = new CreateInteractorContext();
			$this->contextBuilder
				->expects($this->any())
	            ->method("build")
				->willReturn($context);

			$this->fileListBuilder
				->expects($this->once())
		        ->method("build")
				->with($context)
				->willReturn([]);

			$this->createInteractor->run(["CreateUser"]);
		}

		function test_WillGetContentForEveryFileReturnedFromFileListBuilder()
		{
			$context = new CreateInteractorContext();
			$this->contextBuilder
					->expects($this->any())
					->method("build")
					->willReturn($context);

			$this->fileListBuilder
					->expects($this->any())
					->method("build")
					->willReturn(["File1", "File1"]);

			$this->fileSystem
					->expects($this->exactly(2))
					->method("getFileContent")
					->withConsecutive(["File1"], ["File1"]);

			$this->createInteractor->run(["CreateUser"]);
		}

		function test_WillCallTemplateProcessorForEveryFileContent()
		{
			$context = new CreateInteractorContext();
			$this->contextBuilder
					->expects($this->any())
					->method("build")
					->willReturn($context);

			$this->fileListBuilder
					->expects($this->any())
					->method("build")
					->willReturn(["File1", "File1"]);

			$this->fileSystem
					->expects($this->any())
					->method("getFileContent")
					->willReturnOnConsecutiveCalls("Content1", "Content2");

			$this->templateProcessor
					->expects($this->exactly(2))
					->method("processTemplate")
					->withConsecutive(
						[$this->equalTo("Content1"), $context],
						[$this->equalTo("Content2"), $context]
					);

			$this->createInteractor->run(["CreateUser"]);
		}

		function test_WillCallFileSystemSetFileContentForEveryFileContent()
		{
			$context = new CreateInteractorContext();
			$context->setSources("src");
			$context->setCompany("Company");
			$context->setProject("Project");

			$this->contextBuilder
					->expects($this->any())
					->method("build")
					->willReturn($context);

			$this->fileListBuilder
					->expects($this->any())
					->method("build")
					->willReturn(["File1", "File2"]);

			$this->fileSystem
					->expects($this->any())
					->method("getFileContent")
					->willReturn("x");

			$this->templateProcessor
					->expects($this->at(0))
					->method("processTemplate")
					->willReturn("Content1");
			$this->templateProcessor
					->expects($this->at(1))
					->method("processTemplate")
					->willReturn("Content2");

			$this->fileSystem->expects($this->exactly(2))
				->method("setFileContent")
				->withConsecutive(
					[
						$this->equalTo((new Path())->createPath("src", "Company", "Project", "File1")),
						$this->equalTo("Content1")
					],
					[
						$this->equalTo((new Path())->createPath("src", "Company", "Project", "File2")),
						$this->equalTo("Content2")
					]);

			$this->createInteractor->run(["CreateUser"]);
		}

		/**
		 * @return \PHPUnit_Framework_MockObject_MockObject
		 */
		function setUp() {
			$this->presenter         = $this->getMock('Conpago\Cli\Interactor\Contract\ICreateInteractorPresenter');
			$this->fileSystem        = $this->getMock('Conpago\File\Contract\IFileSystem');
			$this->contextBuilder    = $this->getMock('Conpago\Cli\Interactor\Contract\ICreateInteractorContextBuilder');
			$this->fileListBuilder   = $this->getMock('Conpago\Cli\Interactor\Contract\ICreateInteractorTemplateFileListBuilder');
			$this->templateProcessor = $this->getMock('Conpago\Cli\Templates\Contract\ITemplateProcessor');
			$this->createInteractor  = new CreateInteractor(
					$this->presenter,
					$this->contextBuilder,
					$this->fileListBuilder,
					$this->fileSystem,
					$this->templateProcessor,
					new Path()
			);
		}
	}
