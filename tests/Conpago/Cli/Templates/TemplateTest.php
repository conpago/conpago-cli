<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-12
	 * Time: 14:03
	 */

	namespace Conpago\Cli\Templates;


	class TemplateTest extends \PHPUnit_Framework_TestCase {
		/**
		 * @var Template
		 */
		protected $template;

		/**
		 * @var \PHPUnit_Framework_MockObject_MockObject
		 */
		protected $loader;

		/**
		 * @var \PHPUnit_Framework_MockObject_MockObject
		 */
		protected $options;

		function testRenderWillReturnContentFromLoader()
		{
			$this->loader->expects( $this->any() )->method( 'load' )->willReturn( 'temp' );
			$rendered = $this->template->render('dummy');
			$this->assertEquals('temp', $rendered);
		}

		function testRenderWillNormalizeLineEndingsToWindows()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("temp\ntemp\r\ntemp");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\r\n");

			$rendered = $this->template->render('dummy');
			$this->assertEquals("temp\r\ntemp\r\ntemp", $rendered);
		}

		function testRenderWillNormalizeLineEndingsToLinux()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("temp\ntemp\r\ntemp");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\n");

			$rendered = $this->template->render('dummy');
			$this->assertEquals("temp\ntemp\ntemp", $rendered);
		}

		function testRenderWillReplaceVariableWithValue()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("{{variable}}");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\n");

			$rendered = $this->template->render('dummy', ['variable' => 'value']);
			$this->assertEquals("value", $rendered);
		}

		function testRenderWillReplaceVariableInTextWithValue()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("xxx{{variable}}zzz");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\n");

			$rendered = $this->template->render('dummy', ['variable' => 'value']);
			$this->assertEquals("xxxvaluezzz", $rendered);
		}

		function testRenderWillReplaceMutipleVariablesWithValue()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("{{variable}}{{variable2}}");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\n");

			$rendered = $this->template->render('dummy', ['variable' => 'value', 'variable2' => 'value2']);
			$this->assertEquals("valuevalue2", $rendered);
		}

		function testRenderWillReplaceVariableInVariableWithValue()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("{{variable}}{{variable2}}");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\n");

			$rendered = $this->template->render('dummy', ['variable' => '{{variable2}}', 'variable2' => 'value2']);
			$this->assertEquals("value2value2", $rendered);
		}

		function testRenderWillReplaceVariableInLaterDefinedVariableWithValue()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("{{variable}}{{variable2}}");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\n");

			$rendered = $this->template->render('dummy', ['variable' => 'value', 'variable2' => '{{variable}}']);
			$this->assertEquals("valuevalue", $rendered);
		}

		function testRenderWillNotReplaceBraceIfIsNotVariableDefinition()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("{vari{{variable2}}");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\n");

			$rendered = $this->template->render('dummy', ['variable' => 'value', 'variable2' => 'value2']);
			$this->assertEquals("{varivalue2", $rendered);
		}

		function testRenderWillNotReplaceBraceIfIsNotVariableDefinitionAtEnd()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("xxx{v");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\n");

			$rendered = $this->template->render('dummy', ['variable' => 'value', 'variable2' => 'value2']);
			$this->assertEquals("xxx{v", $rendered);
		}

		function testRenderWillNotReplaceIfEndBracesAreSeparate()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("{{variable2}x}");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\n");

			$rendered = $this->template->render('dummy', ['variable' => 'value', 'variable2' => 'value2']);
			$this->assertEquals("{{variable2}x}", $rendered);
		}

		function testRenderWillNotReplaceIfEndBracesAreSeparateNotAtEnd()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("{{variable2}x}zz");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\n");

			$rendered = $this->template->render('dummy', ['variable' => 'value', 'variable2' => 'value2']);
			$this->assertEquals("{{variable2}x}zz", $rendered);
		}

		/**
		 * @expectedException Conpago\Cli\Templates\RecursionTemplateException
		 * @expectedExceptionMessage Template contains recursiv variables: variable > variable2 > variable
		 */
		function testRenderWillReplaceVariableRecursiveInVariablesWillThrowExceptionWithValue()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("{{variable}}{{variable2}}");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\n");

			$this->template->render('dummy', ['variable' => '{{variable2}}', 'variable2' => '{{variable}}']);
		}

		/**
		 * @expectedException Conpago\Cli\Templates\RecursionTemplateException
		 * @expectedExceptionMessage Template contains recursiv variables: variable > variable2 > variable3 > variable4 > variable
		 */
		function testRenderWillReplaceVariableDeepRecursiveInVariablesWillThrowExceptionWithValue()
		{
			$this->loader->expects($this->any())->method('load')->willReturn("{{variable}}{{variable2}}");
			$this->options->expects($this->any())->method('getLineEndings')->willReturn("\n");

			$this->template->render(
					'dummy',
					[
							'variable' => '{{variable2}}',
							'variable2' => '{{variable3}}',
							'variable3' => '{{variable4}}',
							'variable4' => '{{variable}}'
					]
			);
		}

		protected function setUp() {
			$this->loader = $this->getMock( 'Conpago\Cli\Templates\ITemplateLoader' );
			$this->options = $this->getMock( 'Conpago\Cli\Templates\ITemplateOptions' );
			$this->template = new Template( $this->loader, $this->options );
		}
	}
