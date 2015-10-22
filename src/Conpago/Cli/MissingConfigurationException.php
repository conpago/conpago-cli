<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 19.10.15
	 * Time: 23:33
	 */

	namespace Conpago\Cli;


	class MissingConfigurationException extends \Exception {
		/**
		 * @var string
		 */
		protected $path;

		public function getPath(){
			return $this->path;
		}

		function __construct($path, $message = "", $code = 0, \Exception $previous = null ) {
			parent::__construct( $message, $code, $previous );
			$this->path = $path;
		}
	}