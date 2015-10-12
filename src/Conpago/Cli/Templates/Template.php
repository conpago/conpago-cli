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
		protected $variable = "";
		protected $in_variable = false;
		protected $possible_variable_start = false;
		protected $at_variable_end = false;
		protected $possible_variable_end = false;
		protected $variables;
		protected $call_stack;

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

		function fill() {
			while ( feof( $this->in ) === false) {
				$char = fread( $this->in, 1);

				if ($this->possible_variable_end == true && !$this->isEndChar($char)) {
					$this->possible_variable_end = false;
				}
				else if ($this->possible_variable_end == false && $this->in_variable == true && $this->isEndChar($char)) {
					$this->possible_variable_end = true;
				}
				else if ( $this->possible_variable_end == true && $this->at_variable_end == false && $this->isEndChar($char)) {
					$this->at_variable_end = true;
					$this->variable .= $char;
				}
				else if ( $this->possible_variable_start == true && $this->isStartChar($char)) {
					$this->in_variable = $this->possible_variable_start;
				}
				else if ( $this->possible_variable_start == true && $this->in_variable == false && !$this->isStartChar($char)) {
					$this->possible_variable_start = false;
					$this->addToOutput($this->variable);
					$this->variable = "";
				}
				else if ($this->isStartChar($char)) {
					$this->possible_variable_start = true;
					$this->variable .= $char;
				}
				$this->collectVariable( $char );
				if ($this->in_variable == true && $this->at_variable_end == true) {
					$this->addToOutput($this->getVariableReplacement());
					$this->resetState();
				}
				else if ($this->possible_variable_start == false) {
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
			return fread($this->out, 8192);
		}

		private function resetState() {
			$this->variable                = "";
			$this->in_variable             = false;
			$this->possible_variable_start = false;
			$this->at_variable_end         = false;
			$this->possible_variable_end   = false;
			$this->call_stack              = [ ];
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
			if ( $this->in_variable == true && $this->at_variable_end == false ) {
				$this->variable .= $char;
			}
		}

		private function handleBrokenVariable() {
			if ( $this->in_variable ) {
				$this->addToOutput( $this->variable );
			}
		}
	}