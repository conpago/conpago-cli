<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 25.10.15
     * Time: 19:15
     */

    namespace Conpago\Cli\Interactor;

    use Conpago\Cli\Contract\IQuestion;
    use Conpago\Cli\Interactor\Contract\CreateInteractorContext;
    use Conpago\Cli\Interactor\Contract\ICreateInteractorContextBuilder;
    use Conpago\Cli\Interactor\Contract\ICreateInteractorContextBuilderConfig;
    use Conpago\Time\Contract\ITimeService;

    /**
     * Class CreateInteractorContextBuilder
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    class CreateInteractorContextBuilder implements ICreateInteractorContextBuilder
    {
        const YES_ANSWER = "yes";
        const NO_ANSWER = "no";
        /**
         * @var ICreateInteractorContextBuilderConfig
         */
        protected $config;

        /**
         * @var IQuestion
         */
        private $question;
        /**
         * @var ITimeService
         */
        private $timeService;

        /**
         * CreateInteractorContextBuilder constructor.
         *
         * @param IQuestion $question
         * @param ICreateInteractorContextBuilderConfig $config
         * @param ITimeService $timeService
         */
        public function __construct(
            IQuestion $question,
            ICreateInteractorContextBuilderConfig $config,
            ITimeService $timeService
        ) {
            $this->question = $question;
            $this->config = $config;
            $this->timeService = $timeService;
        }

        /**
         * @param string $interactor_name
         *
         * @return CreateInteractorContext
         */
        public function build($interactor_name)
        {
            $context = new CreateInteractorContext();
            $this->gatherDataFromUser($context);
            $this->readConfig($context);
            $context->setInteractorName($interactor_name);

            return $context;
        }

        /**
         * @param $question
         *
         * @return string
         */
        protected function askAboutCreating($question)
        {
            return $this->question->ask($question, [self::YES_ANSWER, self::NO_ANSWER], self::YES_ANSWER);
        }

        /**
         * @param $context
         */
        protected function gatherDataFromUser(CreateInteractorContext $context)
        {
            $context->setVariable(
                    "createAccessRight",
                    $this->askAboutCreating("Create access right for interactor?") == self::YES_ANSWER);
            $context->setVariable(
                    "createRequestData",
                    $this->askAboutCreating("Create request data object for interactor?") == self::YES_ANSWER);
            $context->setVariable(
                    "createRequestDataValidator",
                    $this->askAboutCreating("Create request data validator?") == self::YES_ANSWER);
            $context->setVariable(
                    "createDao",
                    $this->askAboutCreating("Create dao for interactor?") == self::YES_ANSWER);
            $context->setVariable(
                    "createLogger",
                    $this->askAboutCreating("Create logger for interactor?") == self::YES_ANSWER);
            $context->setVariable(
                    "createPresenterModel",
                    $this->askAboutCreating("Create presenter model for interactor?") == self::YES_ANSWER);
            $context->setVariable(
                    "createConpagoDiModule",
                    $this->askAboutCreating("Create Conpago/DI module for interactor?") == self::YES_ANSWER);
        }

        /**
         * @param $context
         */
        protected function readConfig(CreateInteractorContext $context)
        {
            $context->setAuthor($this->config->getAuthor());
            $context->setCompany($this->config->getCompany());
            $context->setProject($this->config->getProject());
            $context->setSources($this->config->getSources());
            $context->setTests($this->config->getTests());
        }
    }
