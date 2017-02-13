<?php

    use Behat\Behat\Context\Context;
    use Behat\Behat\Hook\Scope\AfterFeatureScope;
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
        const TARGET_DIR = './tmp/src';
        const REFERENCE_DIR = './features/resources';

        /** @var FeatureTimeService */
        protected $timeService;

        /** @var QuestionResponseHandler  */
        protected $questionResponseHandler;

        /** @var FeatureApplicationFactory */
        protected $testApplicationFactory;

        /**
         * @AfterFeature
         *
         * @param AfterFeatureScope $scope
         */
        public static function clearTmpSrc(AfterFeatureScope $scope)
        {
            $dir = '.' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . 'src';

            $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new RecursiveIteratorIterator($it,
                RecursiveIteratorIterator::CHILD_FIRST);
            foreach($files as $file) {
                if ($file->isDir()){
                    rmdir($file->getRealPath());
                } else {
                    unlink($file->getRealPath());
                }
            }
            rmdir($dir);
        }

        /**
         * @AfterFeature
         *
         * @param AfterFeatureScope $scope
         */
        public static function clearTwigCache(AfterFeatureScope $scope)
        {
            $dir = '.' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . 'twig-cache';

            $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new RecursiveIteratorIterator($it,
                RecursiveIteratorIterator::CHILD_FIRST);
            foreach($files as $file) {
                if ($file->isDir()){
                    rmdir($file->getRealPath());
                } else {
                    unlink($file->getRealPath());
                }
            }
            rmdir($dir);
        }

        /**
         * Initializes context.
         * Every scenario gets its own context object.
         */
        public function __construct()
        {
            $this->timeService      = new FeatureTimeService();
            $this->questionResponseHandler = new QuestionResponseHandler([]);

            $this->testApplicationFactory = new FeatureApplicationFactory(
                $this->timeService,
                $this->questionResponseHandler,
                $this->questionResponseHandler
            );
        }

        /**
         * @Given The files are not exists:
         */
        public function theFilesAreNotExists(PyStringNode $files)
        {
            foreach ($files->getStrings() as $file) {
                $targetFile = realpath(self::TARGET_DIR) . DIRECTORY_SEPARATOR . $file;
                if (file_exists($targetFile)) {
                    throw new Exception(sprintf("File '%s' exists!", $targetFile));
                }
            }
        }
        /**
         * @Then The files are still not exists:
         */
        public function theFilesAreStillNotExists(PyStringNode $files)
        {
            foreach ($files->getStrings() as $file) {
                $targetFile = realpath(self::TARGET_DIR) . DIRECTORY_SEPARATOR . $file;
                if (file_exists($targetFile)) {
                    throw new Exception(sprintf("File '%s' exists!", $targetFile));
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
            $this->testApplicationFactory->createApplication()->run($cli_args);
        }

        /**
         * @Then File :file exists with following content:
         */
        public function fileExistsWithContent($file, PyStringNode $content)
        {
            if (!file_exists($file) || !is_file($file)) {
                throw new Exception(sprintf("File '%s' does not exist!", $file));
            }

            assertEquals($content->getRaw(), file_get_contents($file));
        }

        /**
         * @When The files exists with content equal to :scenarioName reference file:
         */
        public function theFilesExistsWithContentEqualToReference($scenarioName, PyStringNode $files)
        {
            foreach ($files->getStrings() as $file) {
                $this->fileExistsWithContentEqualToReference($file, $scenarioName);
            }
        }

        /**
         * @Then File :file exists with content equal to :scenarioName reference file:
         */
        public function fileExistsWithContentEqualToReference($file, $scenarioName)
        {
            $targetFile = realpath(self::TARGET_DIR) . DIRECTORY_SEPARATOR . $file;
            $referenceFile = realpath(self::REFERENCE_DIR) . DIRECTORY_SEPARATOR . $scenarioName . DIRECTORY_SEPARATOR . $file . '.ref';

            if (!file_exists($targetFile) || !is_file($targetFile)) {
                throw new Exception(sprintf("File '%s' does not exist!", $targetFile));
            }

            $expected = file_get_contents($referenceFile);
            $generated = file_get_contents($targetFile);

            try {
                assertEquals($expected, $generated, $file . ': Failed asserting that two strings are equal.');
            } catch (Exception $e) {
                echo $e;
                throw $e;
            }
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
            file_put_contents("conpago-cli.yaml", $rawYaml);
        }

        /**
         * @Given I will answer :answer to question :question
         */
        public function iWillAnswerToQuestion($answer, $question)
        {
            $this->questionResponseHandler->addAnswer($question, $answer);
        }

        /**
         * @Then /^All questions was asked$/
         */
        public function allQuestionsWasAsked()
        {
            assertEquals(0,$this->questionResponseHandler->getAnswersCount());
        }
    }
