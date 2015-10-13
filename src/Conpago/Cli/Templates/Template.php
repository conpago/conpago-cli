<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-12
	 * Time: 14:03
	 */

	namespace Conpago\Cli\Templates;


	class Template {
		const START_CHAR = "{";
		const END_CHAR = "}";
		const START_SEQ = "{{";
		const END_SEQ = "}}";
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
		protected $in;
		protected $out;
		protected $variables;
		protected $call_stack;

		protected $variable = "";
		protected $in_variable = false;
		protected $at_variable_end = false;

		/**
		 * @param $content
		 * @param $variables
		 * @param $call_stack
		 */
		function __construct( $content, $variables, $call_stack = []) {
			$this->in  = $this->prepareInStream( $content );
			$this->out = $this->prepareOutStream();

			$this->initial_call_stack = $call_stack;
			$this->call_stack = $call_stack;
			$this->variables  = $variables;
		}

		function fill() {
			while (!feof($this->in)) {
				$char = $this->getNextChar();

				if ($this->in_variable && $this->isEndChar($char)) {
					$second_char = $this->getNextChar();
					$this->variable .= $char . $second_char;
					if ($this->isEndChar($second_char)) {
						$this->at_variable_end = true;
					} else {
						continue;
					}
				}
				else if ($this->isStartChar($char)) {
					$second_char = $this->getNextChar();
					if ($this->isStartChar($second_char)) {
						$this->in_variable = true;
						$this->variable .= $char;
					}
					else if (!$this->isStartChar($second_char)) {
						$this->addToOutput($char.$second_char);
						continue;
					}
				}
				$this->collectVariable( $char );
				if ($this->in_variable && $this->at_variable_end) {
					$this->addToOutput($this->getVariableReplacement());
					$this->resetState();
				}
				else if (!$this->in_variable) {
					$this->addToOutput($char);
				}
			}
			$this->handleBrokenVariable();
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
			return $char == Template::START_CHAR;
		}

		/**
		 * @param $char
		 *
		 * @return bool
		 */
		private function isEndChar($char) {
			return $char == Template::END_CHAR;
		}

		private function getResult() {
			fseek($this->out, 0);
			$result = "";
			while (!feof($this->out)) {
				$result .= fread($this->out, 8192);
			}
			return $result;
		}

		private function resetState() {
			$this->variable                = "";
			$this->in_variable             = false;
			$this->at_variable_end         = false;
			$this->call_stack              = $this->initial_call_stack;
		}

		private function getVariableReplacement() {
			$cut_variable = substr( $this->variable, 2, -2);
			$replacement = $cut_variable;
			if ( array_key_exists( $cut_variable, $this->variables ) ) {
				$recursion          = in_array( $cut_variable, $this->call_stack );
				$this->call_stack[] = $cut_variable;
				if ( $recursion ) {
					throw new RecursionTemplateException( $this->call_stack );
				}

				$replacement = (new TemplateFiller($this->variables[ $cut_variable ], $this->variables, $this->call_stack))->fill();

				return $replacement;
			}

			return $replacement;
		}

		/**
		 * @param $char
		 */
		private function collectVariable( $char ) {
			if ($this->in_variable && !$this->at_variable_end) {
				$this->variable .= $char;
			}
		}

		private function handleBrokenVariable() {
			if ($this->in_variable) {
				$this->addToOutput( $this->variable );
			}
		}

		/**
		 * @return string
		 */
		protected function getNextChar() {
			return fread( $this->in, 1 );
		}
	}