<?php
	/**
	 * Created by PhpStorm.
	 * User: bartosz.golek
	 * Date: 2014-05-23
	 * Time: 08:21
	 */

	namespace Saigon\TeamMate\Presentation\Controller;


	use Conpago\Exceptions\Http400BadRequestException;
	use Conpago\Helpers\Contract\IRequestData;
	use Saigon\TeamMate\Presentation\Contract\Controller\ICreateUserController;
	use Saigon\TeamMate\Business\Contract\Interactor\ICreateUser;
	use Saigon\TeamMate\Presentation\RequestData\CreateUserRequestData;

	class CreateUserController implements ICreateUserController
	{
		/**
		 * @var \Saigon\TeamMate\Business\Contract\Interactor\ICreateUser
		 */
		private $createUser;

		function __construct(ICreateUser $createUser)
		{
			$this->createUser = $createUser;
		}

		function execute(IRequestData $data)
		{
			$parameters = $data->getParameters();

			if ($parameters == null || !array_key_exists('user', $parameters))
				throw new Http400BadRequestException("");

			$requestData = new CreateUserRequestData(
				$parameters['user']['username'],
				$parameters['user']['password'],
				$parameters['user']['passwordConfirmation'],
				$parameters['user']['email'],
				$parameters['user']['nickname']
			);
			$this->createUser->run($requestData);
		}
	}