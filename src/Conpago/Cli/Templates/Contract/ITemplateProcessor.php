<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 04.11.15
     * Time: 21:42
     */

    namespace Conpago\Cli\Templates\Contract;

interface ITemplateProcessor
{
    /**
     * @param string $namespace
     * @param string $templateFile
     * @param ITemplateContext $context
     *
     * @return string
     */
    public function processTemplate($namespace, $templateFile, ITemplateContext $context);
}
