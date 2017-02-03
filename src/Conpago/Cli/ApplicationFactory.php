<?php

    /**
     * Created by PhpStorm.
     * User: bgolek
     * Date: 2015-10-09
     * Time: 14:28
     */

    namespace Conpago\Cli;

    use Conpago\Cli\CaseConverter\CaseConverter;
    use Conpago\Cli\Contract\IInput;
    use Conpago\Cli\Contract\IOutput;
    use Conpago\Cli\Interactor\CreateInteractor;
    use Conpago\Cli\Interactor\CreateInteractorContextBuilder;
    use Conpago\Cli\Interactor\CreateInteractorContextBuilderConfig;
    use Conpago\Cli\Interactor\CreateInteractorTemplateFileListBuilder;
    use Conpago\Cli\Interactor\CreateInteractorPresenter;
    use Conpago\Cli\Templates\Contract\TemplateOptions;
    use Conpago\Cli\Templates\TemplateEnvironment;
    use Conpago\Cli\Templates\TemplateLoader;
    use Conpago\Cli\Templates\TemplateProcessor;
    use Conpago\Config\ArrayConfig;
    use Conpago\Config\Contract\IConfig;
    use Conpago\Config\YamlConfigBuilder;
    use Conpago\File\Contract\IFileSystem;
    use Conpago\File\FileSystem;
    use Conpago\File\Path;
    use Conpago\File\PathBuilder;
    use Conpago\Time\Contract\ITimeService;
    use Conpago\TimeService;

    /**
     * Class ApplicationFactory
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    class ApplicationFactory
    {
        /** @var  IOutput */
        protected $output;

        /** @var  IInput */
        protected $input;

        /** @var  IFileSystem */
        protected $fileSystem;

        /** @var  ITimeService */
        protected $timeService;

        /**
         * @return Application
         */
        public function createApplication()
        {
            $this->createStreamInput();
            $this->createStreamOutput();
            $this->fileSystem = new FileSystem();

            return new Application(
                new ApplicationPresenter($this->output),
                new CommandFactory(
                    [
                        'interactor' => $this->createCommandCreateInteractor()
                    ]
                )
            );
        }

        /**
         * @return Path
         */
        protected function createPath()
        {
            return new Path(".", realpath("."));
        }

        /**
         * @return CaseConverter
         */
        protected function createCaseConverter()
        {
            return new CaseConverter();
        }

        /**
         * @return TemplateLoader
         */
        protected function createTemplateLoader()
        {
            return new TemplateLoader();
        }

        /**
         * @return TemplateOptions
         */
        protected function createTemplateOptions()
        {
            return new TemplateOptions();
        }

        /**
         * @return TemplateEnvironment
         */
        protected function createTemplateEnvironment()
        {
            return new TemplateEnvironment(
                $this->createTemplateLoader(),
                $this->createTemplateOptions()
            );
        }

        /**
         * @return TemplateProcessor
         */
        protected function createTemplateProcessor()
        {
            return new TemplateProcessor(
                $this->createTemplateEnvironment(),
                $this->createCaseConverter()
            );
        }

        /**
         * @return ITimeService
         */
        protected function createTimeService()
        {
            if ($this->timeService == null) {
                $this->timeService = new TimeService();
            }

            return $this->timeService;
        }

        /**
         * @return StreamOutput
         */
        protected function createStreamOutput()
        {
            if ($this->output == null) {
                $this->output = new StreamOutput(STDOUT);
            }

            return $this->output;
        }

        /**
         * @return StreamInput
         */
        protected function createStreamInput()
        {
            if ($this->input == null) {
                $this->input = new StreamInput(STDIN);
            }

            return $this->input;
        }

        /**
         * @return IConfig
         */
        protected function createConfig()
        {
            return new ArrayConfig((new YamlConfigBuilder(
                $this->fileSystem,
                "conpago-cli.yaml"
            ))->build());
        }

        /**
         * @return CreateInteractor
         */
        protected function createCommandCreateInteractor()
        {
            return new CreateInteractor(
                new CreateInteractorPresenter($this->output),
                new CreateInteractorContextBuilder(
                    new Question($this->input, $this->output),
                    new CreateInteractorContextBuilderConfig(
                        $this->createConfig()
                    ),
                    $this->createTimeService()
                ),
                new CreateInteractorTemplateFileListBuilder(),
                $this->fileSystem,
                $this->createTemplateProcessor(),
                $this->createPath(),
                new PathBuilder()
            );
        }
    }
