<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 01.11.15
     * Time: 23:01
     */

    namespace Conpago\Cli\Interactor\Contract;

/**
     * Interface ICreateInteractorTemplateFileListBuilder
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    interface ICreateInteractorTemplateFileListBuilder
    {

        /**
         * @param CreateInteractorContext $context
         *
         * @return string[]
         */
        public function build(CreateInteractorContext $context);
    }
