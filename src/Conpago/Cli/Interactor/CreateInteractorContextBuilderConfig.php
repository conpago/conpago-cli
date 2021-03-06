<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 30.10.15
     * Time: 21:25
     */

    namespace Conpago\Cli\Interactor;

use Conpago\Cli\Interactor\Contract\ICreateInteractorContextBuilderConfig;
    use Conpago\Config\Contract\IConfig;

    /**
     * Class CreateInteractorContextBuilderConfig
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    class CreateInteractorContextBuilderConfig implements ICreateInteractorContextBuilderConfig
    {
        /**
         * @var IConfig
         */
        protected $config;

        /**
         * CreateInteractorContextBuilderConfig constructor.
         *
         * @param IConfig $config
         */
        public function __construct(IConfig $config)
        {
            $this->config = $config;
        }

        public function getAuthor()
        {
            return $this->config->getValue("author");
        }

        public function getCompany()
        {
            return $this->config->getValue("company");
        }

        public function getProject()
        {
            return $this->config->getValue("project");
        }

        public function getSources()
        {
            return $this->config->getValue("sources");
        }

        public function getTests()
        {
            return $this->config->getValue("tests");
        }
    }
