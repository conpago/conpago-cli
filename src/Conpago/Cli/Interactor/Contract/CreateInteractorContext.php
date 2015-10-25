<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 23.10.15
	 * Time: 22:42
	 */

	namespace Conpago\Cli\Interactor\Contract;


	use Conpago\Cli\Contract\ITemplateContext;

	class CreateInteractorContext implements ITemplateContext
	{
		/**
		 * @var string
		 */
		protected $targetPath;
		/**
		 * @var string
		 */
		protected $author;
		/**
		 * @var array
		 */
		protected $variables = [];

		/**
		 * @return string
		 */
		public function getTargetPath()
		{
			return $this->targetPath;
		}

		/**
		 * @param string $targetPath
		 */
		public function setTargetPath($targetPath)
		{
			$this->targetPath = $targetPath;
		}

		/**
		 * @return string
		 */
		public function getAuthor()
		{
			return $this->author;
		}

		/**
		 * @param string $author
		 */
		public function setAuthor($author)
		{
			$this->author = $author;
		}

		/**
		 * @return array
		 */
		public function getVariables()
		{
			return $this->variables;
		}

		/**
		 * @param $name
		 * @param $value
		 */
		public function setVariable($name, $value)
		{
			$this->variables[$name] = $value;
		}
	}