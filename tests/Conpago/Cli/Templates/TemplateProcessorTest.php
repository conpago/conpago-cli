<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 05.02.17
     * Time: 18:30
     */

    namespace Conpago\Cli\Templates;

    use Conpago\Cli\Templates\Contract\ITemplateContext;
    use Conpago\Cli\Templates\Twig\TwigFactory;
    use PHPUnit_Framework_MockObject_MockObject as MockObject;
    use Twig_Environment;

    class TemplateProcessorTest extends  \PHPUnit_Framework_TestCase
    {
        /** @var Twig_Environment | MockObject */
        protected $twigEnvironment;

        /** @var TwigFactory | MockObject */
        protected $twigFactory;

        /** @var ITemplateContext | MockObject */
        private $templateContext;

        /** @var TemplateProcessor */
        private $templateProcessor;

        public function testProcessTemplateWillGetTwigEnvironmentFromFactory()
        {
            $this->twigFactory
                ->expects($this->once())
                ->method('create')
                ->willReturn($this->twigEnvironment);

            $this->templateContext->method('getVariables')->willReturn([]);

            $this->templateProcessor->processTemplate('', '', $this->templateContext);
        }

        public function testProcessTemplateWillReturnContentRenderedByTwig_Environment()
        {
            $content = 'some content';

            $this->templateContext->method('getVariables')->willReturn([]);

            $this->twigFactory->method('create')->willReturn($this->twigEnvironment);
            $this->twigEnvironment
                ->expects($this->once())
                ->method('render')
                ->willReturn($content);

            $result = $this->templateProcessor->processTemplate('','', $this->templateContext);

            $this->assertEquals($content, $result);
        }

        public function testProcessTemplateWillPassTemplatePathWithTplSuffixToTwigEnvironmentRender()
        {
            $templateFile = "content";

            $this->templateContext->method('getVariables')->willReturn([]);

            $this->twigFactory->method('create')->willReturn($this->twigEnvironment);

            $this->twigEnvironment->expects($this->once())
                                  ->method('render')
                                  ->with($templateFile. ".tpl", $this->anything());

            $this->templateProcessor->processTemplate('', $templateFile, $this->templateContext);
        }

        public function testProcessTemplateWillCallTemplateEnvironmentRenderWithContextVariables()
        {
            $variables = ["var1" => 'val1'];

            $this->templateContext->method('getVariables')->willReturn($variables);

            $this->twigFactory->method('create')->willReturn($this->twigEnvironment);

            $this->twigEnvironment->expects($this->once())
                                  ->method('render')
                                  ->with($this->anything(), $this->equalTo($variables));

            $this->templateProcessor->processTemplate('','', $this->templateContext);
        }

        public function setUp()
        {
            $this->templateContext     = $this->createMock(ITemplateContext::class);

            $this->twigEnvironment     = $this->createMock(Twig_Environment::class);
            $this->twigFactory         = $this->createMock(TwigFactory::class);
            $this->templateProcessor   = new TemplateProcessor($this->twigFactory);
        }
    }