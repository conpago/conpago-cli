<?php
	/**
	 * Created by PhpStorm.
	 * User: bgolek
	 * Date: 2015-10-12
	 * Time: 14:03
	 */

	namespace Conpago\Cli\Templates;


	class Template {
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
			$content = $this->loader->load( $template );
			$content = $this->fill($content, $variables);
			return $this->normalize_endings($content, $this->options->getLineEndings());
		}

		private function normalize_endings( $content, $line_endings ) {
			$content = str_replace("\r\n", "\n", $content);
			if ($line_endings != "\n")
				$content = str_replace("\n", $line_endings, $content);
			return $content;
		}

		private function fill( $content, $variables ) {
			$in  = fopen( 'php://memory', 'w' );
			$out = fopen( 'php://memory', 'w' );
			fwrite( $in, $content );
			fseek( $in, 0 );

			$index = 0;
			$variable = "";
			$variable_start = - 1;
			$possible_variable_start = - 1;
			$variable_end = -1;
			$possible_variable_end = -1;
			while ( feof( $in ) === false ) {
				$char = fread( $in, 1 );
				if ($variable_start != -1 && $char == '}' ) {
					$possible_variable_end = $index;
				}
				else if ($possible_variable_end != -1 && $char == '}' ) {
					$variable_end = $possible_variable_end;
				}
				else if ( $possible_variable_start != - 1 && $char == '{' ) {
					$variable_start = $possible_variable_start;
				}
				else if ( $possible_variable_start != - 1 && $char != '{' ) {
					$possible_variable_start = -1;
					fwrite( $out, $char );
				}
				else if ( $char == '{' ) {
					$possible_variable_start = $index;
				}

				if ($variable_start != -1 && $variable_end == -1) {
					$variable .= $char;
				}
				if ($variable_start != -1 && $variable_end != -1) {
					$variable = substr( $variable, 2, -2);
					fwrite($out, $variables[$variable]);
					$variable = "";
					$variable_start = - 1;
					$possible_variable_start = - 1;
					$variable_end = -1;
					$possible_variable_end = -1;
				}
				else
					fwrite( $out, $char );

				$index++;
			}
			//foreach ($variables as $variable => $value)
			//	$result = str_replace("{{".$variable."}}", $value, $result);

			fseek($out, 0);
			return fread($out, 8192);
		}
	}