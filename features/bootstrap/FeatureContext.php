<?php

    use Behat\Behat\Context\Context;
    use Behat\Gherkin\Node\PyStringNode;
    use Conpago\Cli\Application;

    // Require 3rd-party libraries here:
    require_once "vendor/autoload.php";
    require_once "vendor/phpunit/phpunit/src/Framework/Assert/Functions.php";

    /**
     * Features context.
     */
    class FeatureContext implements Context
    {
        /** @var Application  */
        protected $cli;

        /** @var FeatureTimeService */
        protected $timeService;

        /** @var QuestionResponseHandler  */
        protected $questionResponseHandler;

        /**
         * Initializes context.
         * Every scenario gets its own context object.
         */
        public function __construct()
        {
            $this->timeService      = new FeatureTimeService();
            $this->questionResponseHandler = new QuestionResponseHandler([]);

            $testApplicationFactory = new FeatureApplicationFactory(
                $this->timeService,
                $this->questionResponseHandler,
                $this->questionResponseHandler
            );

            $this->cli              = $testApplicationFactory->createApplication();
        }

        /**
         * @Given The files are not exists:
         */
        public function theFilesAreNotExists(PyStringNode $files)
        {
            foreach ($files->getStrings() as $file) {
                if (file_exists($file)) {
                    throw new Exception(sprintf("File '%s' already exists!", $file));
                }
            }
        }

        /**
         * @When I run :command cli command with :args
         * @When I run :command cli command
         */
        public function iRunCliCommand($command, $args = null)
        {
            $cli_args = [$command];
            if ($args != null) {
                $cli_args = array_merge($cli_args, explode(" ", $args));
            }
            $this->cli->run($cli_args);
        }

        /**
         * @Then File :file exists with following content:
         */
        public function theFilesAreExists($file, PyStringNode $content)
        {
            if (!file_exists($file) || !is_file($file)) {
                throw new Exception(sprintf("File '%s' does not exist!", $file));
            }

            assertEquals($content->getRaw(), file_get_contents($file));
        }

            /**
             * @Given Current date is :time
             *
             * @param $time
             */
        public function currentDateIs($date)
        {
            $this->timeService->setDate($date);
        }

        /**
         * @Given Current time is :time
         */
        public function currentTimeIs($time)
        {
            $this->timeService->setTime($time);
        }

        /**
         * @Given Config file exists:
         */
        public function configFileExists(PyStringNode $string)
        {
            $rawYaml = $string->getRaw();
            file_put_contents("../../conpago-cli.yaml", $rawYaml);
        }

        /**
         * @Given I will answer :answer to question :question
         */
        public function iAnswerToQuestion($answer, $question)
        {
            $this->questionResponseHandler->addAnswer($question, $answer);
        }
    }
