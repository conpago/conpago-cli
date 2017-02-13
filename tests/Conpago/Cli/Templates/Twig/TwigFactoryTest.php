<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 07.02.17
     * Time: 20:01
     */

    namespace Conpago\Cli\Templates\Twig;

    use Conpago\Cli\CaseConverter\CaseConverter;
    use PHPUnit_Framework_MockObject_MockObject as MockObject;
    use Conpago\File\Contract\IPathBuilder;

    class TwigFactoryTest extends \PHPUnit_Framework_TestCase
    {
        /** @var  IPathBuilder | MockObject */
        protected $pathBuilder;

        /** @var  CaseConverter | MockObject */
        protected $caseConverter;

        /** @var TwigFactory */
        private $twigFactory;

        public function testCreateWillReturnTwig_EnvironmentWithFileSystemLoader()
        {
            $this->setUp();

            $twigEnv = $this->twigFactory->create('');
            $this->assertTrue($twigEnv->getLoader() instanceof \Twig_Loader_Filesystem);
        }

        public function setUp()
        {
            $this->pathBuilder = $this->createMock(IPathBuilder::class);
            $this->caseConverter = $this->createMock(CaseConverter::class);
            $this->twigFactory = new TwigFactory($this->pathBuilder, $this->caseConverter, '', '');
        }
    }