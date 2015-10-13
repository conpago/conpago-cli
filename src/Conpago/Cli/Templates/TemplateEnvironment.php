<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-12
	 * Time: 14:03
	 */

	namespace Conpago\Cli\Templates;


	class TemplateEnvironment {
		const START_CHAR = "{";
		const END_CHAR = "}";

		/**
		 * @var ITemplateLoader
		 */
		private $loader;
		/**
		 * @var ITemplateOptions
		 */
		private $options;

		function __construct(ITemplateLoader $loader, ITemplateOptions $options) {

			$this->loader = $loader;
			$this->options = $options;
		}

		function render($template, $variables = [])
		{
			$content = $this->loader->load($template);
			$content = $this->fill($content, $variables);
			return $this->normalize_endings($content, $this->options->getLineEndings());
		}

		private function normalize_endings($content, $line_endings) {
			$content = str_replace("\r\n", "\n", $content);
			if ($line_endings != "\n")
				$content = str_replace("\n", $line_endings, $content);
			return $content;
		}

		private function fill($content, $variables) {
			return (new TemplateFiller($content, $variables))->fill();
		}
	}

	class TemplateFiller {
		const IS_NOT_VARIABLE = false;
		const IS_VARIABLE = true;

		protected $in;
		protected $out;
		protected $variables;
		protected $call_stack;

		protected $buffer;
		protected $old_buffer;

		/**
		 * @param $content
		 * @param $variables
		 * @param $call_stack
		 */
		function __construct( $content, $variables, $call_stack = []) {
			$this->in  = $this->prepareInStream( $content );
			$this->out = $this->prepareOutStream();

			$this->call_stack = $call_stack;
			$this->variables  = $variables;
		}

		function readNextToBuffer()
		{
			$char = $this->getNextChar();
			$this->old_buffer = $this->buffer;
			$this->buffer .= $char;


			return $char;
		}

		function readToBuffer()
		{
			$in_variable = false;
			while (!feof($this->in)) {
				$char = $this->readNextToBuffer();
				if ($this->needDump($char)) {
					$this->goToVariablePosition();
					return self::IS_NOT_VARIABLE;
				}

				if ($this->isStartChar($char)) {
					$char = $this->readNextToBuffer();
					if (!$this->isStartChar($char) ) {
						return self::IS_NOT_VARIABLE;
					}

					$in_variable = true;
				}
				else if ($in_variable && $this->isEndChar($char)) {
					$char = $this->readNextToBuffer();
					if ($this->isEndChar($char)) {
						return self::IS_VARIABLE;
					}
					return self::IS_NOT_VARIABLE;
				}
			}

			return self::IS_NOT_VARIABLE;
		}

		function fill() {
			while (!feof($this->in)) {
				$result = $this->readToBuffer();
				if ( $result == self::IS_NOT_VARIABLE ) {
					$this->dumpBuffer();
				} else {
					$this->addToOutput( $this->getVariableReplacement() );
				}
				$this->buffer = "";
			}
			return $this->getResult();
		}

		private function addToOutput($value)
		{
			fwrite( $this->out, $value);
		}

		private function prepareInStream($content) {
			$in = fopen('php://memory', 'w');
			fwrite($in, $content);
			fseek($in, 0);

			return $in;
		}

		private function prepareOutStream() {
			return fopen('php://memory', 'w');
		}

		/**
		 * @param $char
		 *
		 * @return bool
		 */
		private function isStartChar($char) {
			return $char == TemplateEnvironment::START_CHAR;
		}

		/**
		 * @param $char
		 *
		 * @return bool
		 */
		private function isEndChar($char) {
			return $char == TemplateEnvironment::END_CHAR;
		}

		private function getResult() {
			fseek($this->out, 0);
			$result = "";
			while (!feof($this->out)) {
				$result .= fread($this->out, 8192);
			}
			return $result;
		}

		private function getVariableReplacement() {
			$variable = substr( $this->buffer, 2, -2);
			if (!array_key_exists($variable, $this->variables ) ) {
				return $this->buffer;
			}

			$recursion          = in_array( $variable, $this->call_stack );
			$call_stack = array_merge($this->call_stack, [$variable]);
			if ( $recursion ) {
				throw new RecursionTemplateException( $call_stack );
			}

			return (new TemplateFiller($this->variables[ $variable ], $this->variables, $call_stack))->fill();
		}

		/**
		 * @return string
		 */
		protected function getNextChar() {
			return fread( $this->in, 1 );
		}

		private function dumpBuffer() {
			$this->addToOutput($this->buffer);
		}

		private function goToVariablePosition() {
			fseek( $this->in, ftell( $this->in ) - 1 );
			$this->buffer = $this->old_buffer;
		}

		/**
		 * @param $char
		 *
		 * @return bool
		 */
		private function needDump($char) {
			return strlen( $this->old_buffer ) > 0 && $this->isStartChar($char);
		}
	}