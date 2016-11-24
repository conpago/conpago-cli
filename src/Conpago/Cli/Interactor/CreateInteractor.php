<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 08.10.15
     * Time: 22:17
     */

    namespace Conpago\Cli\Interactor;

    use Conpago\Cli\Contract\ICommand;
    use Conpago\Cli\Interactor\Contract\ICreateInteractorContextBuilder;
    use Conpago\Cli\Interactor\Contract\ICreateInteractorPresenter;
    use Conpago\Cli\Interactor\Contract\ICreateInteractorTemplateFileListBuilder;
    use Conpago\Cli\Templates\Contract\ITemplateProcessor;
    use Conpago\File\Contract\IFileSystem;
    use Conpago\File\Contract\IPath;
    use Conpago\File\Contract\IPathBuilder;

    /**
     * Class CreateInteractor
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    class CreateInteractor implements ICommand
    {
        /**
         * @var IFileSystem
         */
        protected $fileSystem;
        /**
         * @var IPath
         */
        protected $path;
        /**
         * @var IPathBuilder
         */
        protected $pathBuilder;

        /**
         * @var ICreateInteractorTemplateFileListBuilder
         */
        private $fileListBuilder;
        /**
         * @var ICreateInteractorPresenter
         */
        private $presenter;
        /**
         * @var ICreateInteractorContextBuilder
         */
        private $contextBuilder;
        /**
         * @var ITemplateProcessor
         */
        private $templateProcessor;

        /**
         * CreateInteractor constructor.
         *
         * @param ICreateInteractorPresenter $presenter
         * @param ICreateInteractorContextBuilder $contextBuilder
         * @param ICreateInteractorTemplateFileListBuilder $fileListBuilder
         * @param IFileSystem $fileSystem
         * @param ITemplateProcessor $templateProcessor
         * @param IPath $path
         * @param IPathBuilder $pathBuilder
         */
        public function __construct(
            ICreateInteractorPresenter $presenter,
            ICreateInteractorContextBuilder $contextBuilder,
            ICreateInteractorTemplateFileListBuilder $fileListBuilder,
            IFileSystem $fileSystem,
            ITemplateProcessor $templateProcessor,
            IPath $path,
            IPathBuilder $pathBuilder
        ) {
            $this->presenter      = $presenter;
            $this->contextBuilder = $contextBuilder;
            $this->fileListBuilder = $fileListBuilder;
            $this->fileSystem = $fileSystem;
            $this->templateProcessor = $templateProcessor;
            $this->path = $path;
            $this->pathBuilder = $pathBuilder;
        }

        public function printHelp()
        {
            $this->presenter->printHelp($this->getDescription());
        }

        public function run(array $args)
        {
            if (count($args) < 1) {
                $this->printMissingParameter();
                $this->printHelp();
                return;
            }

            $interactor_name = $args[0];

            $context = $this->contextBuilder->build($interactor_name);
            $file_list = $this->fileListBuilder->build($context);
            foreach ($file_list as $file) {
                $template = $this->fileSystem->getFileContent($file);
                $output = $this->templateProcessor->processTemplate($template, $context);
                $fullOutputFileName =
                    $this->pathBuilder->createPath([
                        $context->getSources(),
                        $context->getCompany(),
                        $context->getProject(),
                        str_replace("{{name}}", $interactor_name, $file)
                    ]);
                $this->fileSystem->setFileContent($fullOutputFileName, $output);
            }
        }

        public function getDescription()
        {
            return "Generate interactor with interfaces and adapters stubs. It also generate tests stubs.".PHP_EOL;
        }

        protected function printMissingParameter()
        {
            $this->presenter->printMissingParameter();
        }
    }
