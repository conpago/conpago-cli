<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 17.10.15
	 * Time: 23:46
	 */

	namespace Conpago\Cli\Contract;


	class CommandHelp {
		/**
		 * @var string
		 */
		protected $name;
		/**
		 * @var string
		 */
		protected $help_text;

		/**
		 * CommandHelp constructor.
		 *
		 * @param $name
		 * @param $help_text
		 */
		public function __construct($name, $help_text) {

			$this->name = $name;
			$this->help_text = $help_text;
		}

		/**
		 * @return string
		 */
		public function getName() {
			return $this->name;
		}

		/**
		 * @return string
		 */
		public function getHelpText() {
			return $this->help_text;
		}
	}