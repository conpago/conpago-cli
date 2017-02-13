<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 13.10.15
     * Time: 23:25
     */

    namespace Conpago\Cli\Templates;

use Conpago\Cli\CaseConverter\CaseConverter;
    use Conpago\Cli\Templates\Contract\ITemplateContext;
    use Conpago\Cli\Templates\Contract\ITemplateProcessor;
use Conpago\Cli\Templates\Twig\TwigFactory;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
     * Class TemplateProcessor
     *
     * @license MIT
     * @author Bartosz Gołek <bartosz.golek@gmail.com>
     */
    class TemplateProcessor implements ITemplateProcessor
    {
        /**
         * @var TwigFactory
         */
        private $twigFactory;

        /**
         * TemplateProcessor constructor.
         */
        public function __construct(TwigFactory $twigFactory)
        {
            $this->twigFactory = $twigFactory;
        }


        /**

         * @param string $templateFile
         * @param ITemplateContext $context
         *
         * @return string
         */
        public function processTemplate($namespace, $templateFile, ITemplateContext $context)
        {
            $twigEnv = $this->twigFactory->create($namespace);
            return $twigEnv->render($templateFile . '.twig', $context->getVariables());
        }
    }
