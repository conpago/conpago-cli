<?php
    /**
     * Created by PhpStorm.
     * User: bgolek
     * Date: 2015-10-12
     * Time: 14:05
     */

    namespace Conpago\Cli\Templates\Contract;

/**
     * Interface ITemplateLoader
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    interface ITemplateLoader
    {
        public function load($template);
    }
