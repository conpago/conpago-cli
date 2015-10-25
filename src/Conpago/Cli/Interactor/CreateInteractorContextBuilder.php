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

	class CreateInteractorContextBuilder implements ICreateInteractorContextBuilder
	{
		const YES_ANSWER = "yes";
		const NO_ANSWER = "no";

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
			IQuestion $question
		)
		{
			$this->question = $question;
		}
		/**
		 * @return CreateinteractorContext
		 */
		public function build()
		{
			$context = new CreateinteractorContext();
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
	}