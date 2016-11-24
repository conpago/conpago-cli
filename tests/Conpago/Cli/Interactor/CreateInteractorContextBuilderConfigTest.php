<?php
    /**
     * Created by PhpStorm.
     * User: bg
     * Date: 30.10.15
     * Time: 22:41
     */

    namespace Conpago\Cli\Interactor;

use Conpago\Config\Contract\IConfig;

class CreateInteractorContextBuilderConfigTest extends \PHPUnit_Framework_TestCase
{
    /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        protected $config;
        /**
         * @var CreateInteractorContextBuilderConfig
         */
        protected $subject;

    public function test_GetAuthorFromConfigAuthorField()
    {
        $this->config->expects($this->any())
                ->method("getValue")
                ->with('author')
                ->willReturn("AuthorName");
        $this->assertEquals("AuthorName", $this->subject->getAuthor());
    }

    public function test_GetCompanyFromConfigCompanyField()
    {
        $this->config->expects($this->any())
                    ->method("getValue")
                    ->with('company')
                    ->willReturn("CompanyName");
        $this->assertEquals("CompanyName", $this->subject->getCompany());
    }

    public function test_GetProjectFromConfigProjectField()
    {
        $this->config->expects($this->any())
                    ->method("getValue")
                    ->with('project')
                    ->willReturn("ProjectName");
        $this->assertEquals("ProjectName", $this->subject->getProject());
    }

    public function test_GetSourcesProjectFromConfigSourcesField()
    {
        $this->config->expects($this->any())
                    ->method("getValue")
                    ->with('sources')
                    ->willReturn("SourcesDir");
        $this->assertEquals("SourcesDir", $this->subject->getSources());
    }

    public function test_GetTestsFromConfigTestsField()
    {
        $this->config->expects($this->any())
                    ->method("getValue")
                    ->with('tests')
                    ->willReturn("TestsDir");
        $this->assertEquals("TestsDir", $this->subject->getTests());
    }

    public function setUp()
    {
        $this->config = $this->createMock(IConfig::class);
        $this->subject = new CreateInteractorContextBuilderConfig($this->config);
    }
}
