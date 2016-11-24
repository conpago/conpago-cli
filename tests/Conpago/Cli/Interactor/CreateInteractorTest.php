<?php

    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 16.10.15
     * Time: 23:10
     */

    namespace Conpago\Cli\Interactor;

use Conpago\Cli\Interactor\Contract\CreateInteractorContext;
use Conpago\Cli\Interactor\Contract\ICreateInteractorContextBuilder;
use Conpago\Cli\Interactor\Contract\ICreateInteractorPresenter;
use Conpago\Cli\Interactor\Contract\ICreateInteractorTemplateFileListBuilder;
use Conpago\Cli\Templates\Contract\ITemplateProcessor;
use Conpago\File\Contract\IFileSystem;
use Conpago\File\Path;

class CreateInteractorTest extends \PHPUnit_Framework_TestCase
    {

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
        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        protected $pathBuilder;

        public function test_PrintHelp_willPrintHelp()
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

        public function test_GetDescriptionWillReturnDescription()
        {
            $description = $this->createInteractor->getDescription();
            $this->assertEquals($this->expectedDescription(), $description);
        }

        public function test_CommandRunWithMissingParameters_willPrintMissingParametersAndHelp()
        {
            $this->presenter->expects($this->once())
                            ->method("printMissingParameter");
            $this->presenter->expects($this->once())
                            ->method("printHelp");
            $this->createInteractor->run([]);
        }

        public function test_WillCallContextBuilder()
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

        public function test_WillPassContextToTemplateFileListBuilder()
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

        public function test_WillGetContentForEveryFileReturnedFromFileListBuilder()
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

        public function test_WillCallTemplateProcessorForEveryFileContent()
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

        public function test_WillCallFileSystemSetFileContentForEveryFileContent()
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
                        $this->equalTo($this->pathBuilder->createPath("src", "Company", "Project", "File1")),
                        $this->equalTo("Content1")
                    ],
                    [
                        $this->equalTo($this->pathBuilder->createPath("src", "Company", "Project", "File2")),
                        $this->equalTo("Content2")
                    ]);

            $this->createInteractor->run(["CreateUser"]);
        }

        public function test_WillReplaceNameVariableInFile()
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
                    ->willReturn(["{{name}}File1"]);

            $this->fileSystem
                    ->expects($this->any())
                    ->method("getFileContent")
                    ->willReturn("x");

            $this->templateProcessor
                    ->expects($this->any())
                    ->method("processTemplate")
                    ->willReturn("");

            $this->fileSystem->expects($this->once(0))
                 ->method("setFileContent")
                 ->with(
                     $this->equalTo("src\\Company\\Project\\CreateUserFile1"),
                     $this->anything()
                 );

            $this->createInteractor->run(["CreateUser"]);
        }

        /**
         * @return \PHPUnit_Framework_MockObject_MockObject
         */
        public function setUp()
        {
            $this->presenter         = $this->createMock(ICreateInteractorPresenter::class);
            $this->fileSystem        = $this->createMock(IFileSystem::class);
            $this->contextBuilder    = $this->createMock(ICreateInteractorContextBuilder::class);
            $this->fileListBuilder   = $this->createMock(ICreateInteractorTemplateFileListBuilder::class);
            $this->templateProcessor = $this->createMock(ITemplateProcessor::class);
            $this->pathBuilder       = new \Conpago\Cli\PathBuilderMock();

            $this->createInteractor  = new CreateInteractor(
                $this->presenter,
                $this->contextBuilder,
                $this->fileListBuilder,
                $this->fileSystem,
                $this->templateProcessor,
                new Path(".", "."),
                $this->pathBuilder
            );
        }
    }
