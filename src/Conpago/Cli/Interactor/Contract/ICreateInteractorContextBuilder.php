<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 25.10.15
     * Time: 19:14
     */

    namespace Conpago\Cli\Interactor\Contract;

/**
     * Interface ICreateInteractorContextBuilder
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    interface ICreateInteractorContextBuilder
    {
        /**
         * @param string $interactor_name
         *
         * @return CreateInteractorContext
         */
        public function build($interactor_name);
    }
