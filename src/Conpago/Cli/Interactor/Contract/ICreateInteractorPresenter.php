<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 17.10.15
     * Time: 10:13
     */

    namespace Conpago\Cli\Interactor\Contract;

/**
     * Interface ICreateInteractorPresenter
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    interface ICreateInteractorPresenter
    {

        /**
         * @param $desc
         */
        public function printHelp($desc);

        /**
         * @return void
         */
        public function printMissingParameter();
    }
