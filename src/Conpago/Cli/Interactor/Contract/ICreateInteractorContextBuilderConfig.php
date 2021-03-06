<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 30.10.15
     * Time: 21:17
     */

    namespace Conpago\Cli\Interactor\Contract;

/**
     * Interface ICreateInteractorContextBuilderConfig
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    interface ICreateInteractorContextBuilderConfig
    {
        /**
         * @return mixed
         */
        public function getCompany();

        /**
         * @return mixed
         */
        public function getAuthor();

        /**
         * @return mixed
         */
        public function getProject();

        /**
         * @return mixed
         */
        public function getSources();

        /**
         * @return mixed
         */
        public function getTests();
    }
