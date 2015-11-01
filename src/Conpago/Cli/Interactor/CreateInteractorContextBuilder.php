<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 25.10.15
	 * Time: 19:15
	 */

	namespace Conpago\Cli\Interactor;


	use Conpago\Cli\Contract\IQuestion;
	use Conpago\Cli\Interactor\Contract\CreateinteractorContext;
	use Conpago\Cli\Interactor\Contract\ICreateInteractorContextBuilder;
	use Conpago\Cli\Interactor\Contract\ICreateInteractorContextBuilderConfig;

	class CreateInteractorContextBuilder implements ICreateInteractorContextBuilder
	{
		const YES_ANSWER = "yes";
		const NO_ANSWER = "no";
		/**
		 * @var ICreateInteractorContextBuilderConfig
		 */
		protected $config;

		/**
		 * @var IQuestion
		 */
		private $question;

		/**
		 * CreateInteractorContextBuilder constructor.
		 *
		 * @param IQuestion $question
		 */
		function __construct(
			IQuestion $question,
			ICreateInteractorContextBuilderConfig $config
		)
		{
			$this->question = $question;
			$this->config = $config;
		}
		/**
		 * @return CreateinteractorContext
		 */
		public function build()
		{
			$context = new CreateinteractorContext();
			$this->gatherDataFromUser($context);
			$this->readConfig($context);

			return $context;
		}

		/**
		 * @param $question
		 *
		 * @return string
		 */
		protected function askAboutCreating($question)
		{
			return $this->question->ask($question, [self::YES_ANSWER, self::NO_ANSWER], self::YES_ANSWER);
		}

		/**
		 * @param $context
		 */
		protected function gatherDataFromUser($context)
		{
			$context->setVariable(
					"createAccessRight",
					$this->askAboutCreating("Create access right for interactor?") == self::YES_ANSWER);
			$context->setVariable(
					"createRequestData",
					$this->askAboutCreating("Create request data object for interactor?") == self::YES_ANSWER);
			$context->setVariable(
					"createRequestDataValidator",
					$this->askAboutCreating("Create request data validator?") == self::YES_ANSWER);
			$context->setVariable(
					"createDao",
					$this->askAboutCreating("Create dao for interactor?") == self::YES_ANSWER);
			$context->setVariable(
					"createLogger",
					$this->askAboutCreating("Create logger for interactor?") == self::YES_ANSWER);
			$context->setVariable(
					"createPreseterModel",
					$this->askAboutCreating("Create preseter model for interactor?") == self::YES_ANSWER);
			$context->setVariable(
					"createConpagoDiModule",
					$this->askAboutCreating("Create Conpago/DI module for interactor?") == self::YES_ANSWER);
		}

		/**
		 * @param $context
		 */
		protected function readConfig($context)
		{
			$context->setVariable("author", $this->config->getAuthor());
			$context->setVariable("company", $this->config->getCompany());
			$context->setVariable("project", $this->config->getProject());
			$context->setVariable("sources", $this->config->getSources());
			$context->setVariable("tests", $this->config->getTests());
		}
	}