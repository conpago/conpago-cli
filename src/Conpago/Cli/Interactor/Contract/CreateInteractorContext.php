<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 23.10.15
     * Time: 22:42
     */

    namespace Conpago\Cli\Interactor\Contract;

use Conpago\Cli\Templates\Contract\ITemplateContext;
use DateTime;

/**
     * Class CreateInteractorContext
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    class CreateInteractorContext implements ICreateInteractorContext
    {
        const DATETIME_VAR_NAME = 'datetime';
        const AUTHOR_VAR_NAME = "author";
        const COMPANY_VAR_NAME = "company";
        const PROJECT_VAR_NAME = "project";
        const SOURCES_VAR_NAME = "sources";
        const TESTS_VAR_NAME = "tests";
        const INTERACTOR_NAME_VAR_NAME = "name";

        /** @var array */
        protected $variables = [];

        /** @return array */
        public function getVariables()
        {
            return $this->variables;
        }

        /**
         * @param string $name
         * @param mixed $value
         */
        public function setVariable($name, $value)
        {
            $this->variables[$name] = $value;
        }

        /**
         * @param string $name
         *
         * @return mixed|null
         */
        public function getVariable($name)
        {
            if (!array_key_exists($name, $this->variables)) {
                return null;
            }

            return $this->variables[$name];
        }

        /**
         * @return string
         */
        public function getAuthor()
        {
            return $this->getVariable(self::AUTHOR_VAR_NAME);
        }

        /**
         * @param string $author
         */
        public function setAuthor($author)
        {
            $this->setVariable(self::AUTHOR_VAR_NAME, $author);
        }

        /**
         * @param string $company
         */
        public function setCompany($company)
        {
            $this->setVariable(self::COMPANY_VAR_NAME, $company);
        }

        /**
         * @return mixed|null
         */
        public function getCompany()
        {
            return $this->getVariable(self::COMPANY_VAR_NAME);
        }

        /**
         * @param string $project
         */
        public function setProject($project)
        {
            $this->setVariable(self::PROJECT_VAR_NAME, $project);
        }

        /**
         * @return string|null
         */
        public function getProject()
        {
            return $this->getVariable(self::PROJECT_VAR_NAME);
        }

        /**
         * @param string $sources
         */
        public function setSources($sources)
        {
            $this->setVariable(self::SOURCES_VAR_NAME, $sources);
        }

        /**
         * @return string|null
         */
        public function getSources()
        {
            return $this->getVariable(self::SOURCES_VAR_NAME);
        }

        /**
         * @param string $tests
         */
        public function setTests($tests)
        {
            $this->setVariable(self::TESTS_VAR_NAME, $tests);
        }

        /**
         * @return string|null
         */
        public function getTests()
        {
            return $this->getVariable(self::TESTS_VAR_NAME);
        }

        /**
         * @param string $interactorName
         */
        public function setInteractorName($interactorName)
        {
            $this->setVariable(self::INTERACTOR_NAME_VAR_NAME, $interactorName);
        }

        /**
         * @return mixed|null
         */
        public function getInteractorName()
        {
            return $this->getVariable(self::INTERACTOR_NAME_VAR_NAME);
        }

        /**
         * @param DateTime $dateTime
         */
        public function setDateTime(DateTime $dateTime)
        {
            return $this->setVariable(self::DATETIME_VAR_NAME, $dateTime);
        }

        /**
         * @return DateTime|null
         */
        public function getDateTime()
        {
            return $this->getVariable(self::DATETIME_VAR_NAME);
        }
    }
