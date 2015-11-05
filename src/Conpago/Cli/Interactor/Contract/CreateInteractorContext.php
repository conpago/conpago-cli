<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 23.10.15
	 * Time: 22:42
	 */

	namespace Conpago\Cli\Interactor\Contract;


	use Conpago\Cli\Templates\Contract\ITemplateContext;

	/**
	 * Class CreateInteractorContext
	 *
	 * @license MIT
	 * @author Bartosz Gołek <bartosz.golek@gmail.com>
	 */
	class CreateInteractorContext implements ICreateInteractorContext
	{
		/**
		 * @var array
		 */
		protected $variables = [];
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

		public function getVariable($name)
		{
			if (!array_key_exists($name, $this->variables))
				return null;

			return $this->variables[$name];
		}

		private $author_var_name = "author";
		/**
		 * @return string
		 */
		public function getAuthor()
		{
			return $this->getVariable($this->author_var_name);
		}
		/**
		 * @param string $author
		 */
		public function setAuthor($author)
		{
			$this->setVariable($this->author_var_name, $author);
		}

		private $company_var_name = "company";
		public function setCompany($company) {
			$this->setVariable($this->company_var_name, $company);
		}
		public function getCompany() {
			return $this->getVariable($this->company_var_name);
		}

		private $project_var_name = "project";
		public function setProject($project) {
			$this->setVariable($this->project_var_name, $project);
		}
		public function getProject() {
			return $this->getVariable($this->project_var_name);
		}

		private $sources_var_name = "sources";
		public function setSources($sources) {
			$this->setVariable($this->sources_var_name, $sources);
		}
		public function getSources() {
			return $this->getVariable($this->sources_var_name);
		}

		private $tests_var_name = "tests";
		public function setTests($tests) {
			$this->setVariable($this->tests_var_name, $tests);
		}
		public function getTests() {
			return $this->getVariable($this->tests_var_name);
		}

		private $interactor_name_var_name = "name";
		public function setInteractorName($interactor_name) {
			$this->setVariable($this->interactor_name_var_name, $interactor_name);
		}
		public function getInteractorName() {
			return $this->getVariable($this->interactor_name_var_name);
		}
	}