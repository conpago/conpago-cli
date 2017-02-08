<?php

    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 16.10.15
     * Time: 23:10
     */

    namespace Conpago\Cli\Interactor;

    require_once realpath(__DIR__.'/../PathBuilderMock.php');

    use Conpago\Cli\Interactor\Contract\CreateInteractorContext;
    use Conpago\Cli\Interactor\Contract\ICreateInteractorContextBuilder;
    use Conpago\Cli\Interactor\Contract\ICreateInteractorPresenter;
    use Conpago\Cli\Interactor\Contract\ICreateInteractorTemplateFileListBuilder;
    use Conpago\Cli\PathBuilderMock;
    use Conpago\Cli\Templates\Contract\ITemplateProcessor;
    use Conpago\File\Contract\IFileSystem;
    use Conpago\File\Contract\IPathBuilder;
    use Conpago\File\Path;
    use Phake;
    use Phake_IMock;
    use PHPUnit_Framework_MockObject_MockObject as MockObject;

    class CreateInteractorTest extends \PHPUnit_Framework_TestCase
    {

        /** @var ICreateInteractorPresenter | MockObject */
        protected $presenter;

        /** @var ICreateInteractorContextBuilder | MockObject */
        protected $contextBuilder;

        /** @var ICreateInteractorTemplateFileListBuilder | MockObject */
        protected $fileListBuilder;

        /** @var IFileSystem | Phake_IMock*/
        protected $fileSystem;

        /** @var ITemplateProcessor | MockObject */
        protected $templateProcessor;

        /** @var IPathBuilder | MockObject */
        protected $pathBuilder;

        /** @var CreateInteractor */
        protected $createInteractor;

        public function test_PrintHelp_willPrintHelp()
        {
            $this->presenter->expects($this->once())
                    ->method('printHelp');
            $this->createInteractor->printHelp();
        }

        private function expectedDescription()
        {
            return 'Generate interactor with interfaces and adapters stubs. '.
                   'It also generate tests stubs.'.PHP_EOL;
        }

        public function test_GetDescriptionWillReturnDescription()
        {
            $description = $this->createInteractor->getDescription();
            $this->assertEquals($this->expectedDescription(), $description);
        }

        public function test_CommandRunWithMissingParameters_willPrintMissingParametersAndHelp()
        {
            $this->presenter->expects($this->once())
                            ->method('printMissingParameter');
            $this->presenter->expects($this->once())
                            ->method('printHelp');
            $this->createInteractor->run([]);
        }

        public function test_WillCallContextBuilder()
        {
            $context = new CreateInteractorContext();
            $this->contextBuilder->expects($this->once())
                                 ->method('build')
                                 ->willReturn($context);

            $this->fileListBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn([]);

            $this->createInteractor->run(['CreateUser']);
        }

        public function test_WillPassContextToTemplateFileListBuilder()
        {
            $context = new CreateInteractorContext();
            $this->contextBuilder
                ->expects($this->any())
                ->method('build')
                ->willReturn($context);

            $this->fileListBuilder
                ->expects($this->once())
                ->method('build')
                ->with($context)
                ->willReturn([]);

            $this->createInteractor->run(['CreateUser']);
        }

        public function test_WillGetContentForEveryFileReturnedFromFileListBuilder()
        {
            $context = new CreateInteractorContext();
            $this->contextBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn($context);

            $this->fileListBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn(['File1', 'File2']);

            $this->createInteractor->run(['CreateUser']);
        }

        public function test_WillCallTemplateProcessorForEveryFileContent()
        {
            $context = new CreateInteractorContext();
            $this->contextBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn($context);

            $this->fileListBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn(['File1', 'File2']);

            $this->templateProcessor
                    ->expects($this->exactly(2))
                    ->method('processTemplate')
                    ->withConsecutive(
                        [$this->equalTo(CreateInteractor::NAMESPACE), $this->equalTo('File1'), $context],
                        [$this->equalTo(CreateInteractor::NAMESPACE), $this->equalTo('File2'), $context]
                    );

            $this->createInteractor->run(['CreateUser']);
        }

        public function test_WillCallFileSystemSetFileContentForEveryFileContent()
        {
            $context = new CreateInteractorContext();
            $context->setSources('src');
            $context->setCompany('Company');
            $context->setProject('Project');

            $this->contextBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn($context);

            $this->fileListBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn(['File1', 'File2']);

            Phake::when($this->fileSystem)->getFileContent()->thenReturn('x');

            $this->templateProcessor
                    ->expects($this->at(0))
                    ->method('processTemplate')
                    ->willReturn('Content1');
            $this->templateProcessor
                    ->expects($this->at(1))
                    ->method('processTemplate')
                    ->willReturn('Content2');

            $this->createInteractor->run(['CreateUser']);

            Phake::verify($this->fileSystem, Phake::times(1))->setFileContent(
                $this->pathBuilder->createPath(['src', 'Company', 'Project', 'File1']),
                'Content1'
            );

            Phake::verify($this->fileSystem, Phake::times(1))->setFileContent(
                $this->pathBuilder->createPath(['src', 'Company', 'Project', 'File2']),
                'Content2'
            );
        }

        public function test_WillCallFileSystemCreateDirectoryWithRecursiveForEveryFileContent()
        {
            $context = new CreateInteractorContext();
            $context->setSources('src');
            $context->setCompany('Company');
            $context->setProject('Project');

            $this->contextBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn($context);

            $this->fileListBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn(['File1', 'File2']);

            $this->createInteractor->run(['CreateUser']);

            Phake::verify($this->fileSystem, Phake::times(2))->createDirectory(
                $this->pathBuilder->createPath(['src', 'Company', 'Project']),
                true
            );
        }

        public function test_WillReplaceNameVariableInFile()
        {
            $context = new CreateInteractorContext();
            $context->setSources('src');
            $context->setCompany('Company');
            $context->setProject('Project');

            $this->contextBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn($context);

            $this->fileListBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn(['{{name}}File1']);

            Phake::when($this->fileSystem)->getFileContent()->thenReturn('x');

            $this->templateProcessor
                    ->expects($this->any())
                    ->method('processTemplate')
                    ->willReturn('');

            $this->createInteractor->run(['CreateUser']);

            Phake::verify($this->fileSystem, Phake::times(1))->setFileContent(
                'src/Company/Project/CreateUserFile1',
                $this->anything()
            );
        }

        public function test_WillCallFileSystemCreateDirectoryBeforeFileSystemSetFileContent()
        {
            $context = new CreateInteractorContext();
            $context->setSources('src');
            $context->setCompany('Company');
            $context->setProject('Project');

            $this->fileListBuilder
                ->expects($this->any())
                ->method('build')
                ->willReturn(['File1']);

            $this->contextBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn($context);

            $this->createInteractor->run(['CreateUser']);

            Phake::inOrder(
                Phake::verify($this->fileSystem)->createDirectory($this->anything(), $this->anything()),
                Phake::verify($this->fileSystem)->setFileContent($this->anything(), $this->anything())
            );
        }

        public function test_WillCallFileSystemCreateDirectoryOnlyIfItNotExists()
        {
            $context = new CreateInteractorContext();
            $context->setSources('src');
            $context->setCompany('Company');
            $context->setProject('Project');

            $this->fileListBuilder
                ->expects($this->any())
                ->method('build')
                ->willReturn(['File1']);

            $this->contextBuilder
                    ->expects($this->any())
                    ->method('build')
                    ->willReturn($context);

            Phake::when($this->fileSystem)->fileExists($this->anything())->thenReturn(true);

            $this->createInteractor->run(['CreateUser']);

            Phake::verify($this->fileSystem, Phake::times(0))->createDirectory($this->anything(), $this->anything());
        }

        public function setUp()
        {
            $this->presenter         = $this->createMock(ICreateInteractorPresenter::class);
            $this->contextBuilder    = $this->createMock(ICreateInteractorContextBuilder::class);
            $this->fileListBuilder   = $this->createMock(ICreateInteractorTemplateFileListBuilder::class);
            $this->fileSystem        = Phake::mock(IFileSystem::class);
            $this->templateProcessor = $this->createMock(ITemplateProcessor::class);
            $this->pathBuilder       = new PathBuilderMock();

            $this->createInteractor  = new CreateInteractor(
                $this->presenter,
                $this->contextBuilder,
                $this->fileListBuilder,
                $this->fileSystem,
                $this->templateProcessor,
                new Path('.', '.'),
                $this->pathBuilder
            );
        }
    }
