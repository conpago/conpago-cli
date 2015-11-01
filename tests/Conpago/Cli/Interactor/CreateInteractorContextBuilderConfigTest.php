<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 30.10.15
	 * Time: 22:41
	 */

	namespace Conpago\Cli\Interactor;


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

		function test_GetAuthorFromConfigAuthorField()
		{
			$this->config->expects($this->any())
				->method("getValue")
				->with('author')
				->willReturn("AuthorName");
			$this->assertEquals("AuthorName", $this->subject->getAuthor());
		}

		function test_GetCompanyFromConfigCompanyField()
		{
			$this->config->expects($this->any())
					->method("getValue")
					->with('company')
					->willReturn("CompanyName");
			$this->assertEquals("CompanyName", $this->subject->getCompany());
		}

		function test_GetProjectFromConfigProjectField()
		{
			$this->config->expects($this->any())
					->method("getValue")
					->with('project')
					->willReturn("ProjectName");
			$this->assertEquals("ProjectName", $this->subject->getProject());
		}

		function test_GetSourcesProjectFromConfigSourcesField()
		{
			$this->config->expects($this->any())
					->method("getValue")
					->with('sources')
					->willReturn("SourcesDir");
			$this->assertEquals("SourcesDir", $this->subject->getSources());
		}

		function test_GetTestsFromConfigTestsField()
		{
			$this->config->expects($this->any())
					->method("getValue")
					->with('tests')
					->willReturn("TestsDir");
			$this->assertEquals("TestsDir", $this->subject->getTests());
		}

		function setUp()
		{
			$this->config = $this->getMock('Conpago\Config\Contract\IConfig');
			$this->subject = new CreateInteractorContextBuilderConfig($this->config);
		}
	}
