<?php
	/**
	 * Created by PhpStorm.
	 * User: bartosz.golek
	 * Date: 2014-05-23
	 * Time: 08:29
	 */

	namespace Saigon\TeamMate\Business\Interactor;


	use Conpago\AccessRight\Contract\IAccessRightDao;
	use Conpago\AccessRight\Contract\IAccessRightPresenter;
	use Saigon\TeamMate\Business\Contract\Interactor\ICreateUser;
	use Saigon\TeamMate\Business\Contract\Logger\ICreateUserAccessRightLogger;
	use Saigon\TeamMate\Business\Contract\RequestData\ICreateUserRequestData;

	class CreateUserAccessRight implements ICreateUser
	{
		const CREATE_USER_ACCESS_RIGHT = "CreateUserAccessRight";

		/**
		 * @var IAccessRightDao
		 */
		private $dao;
		/**
		 * @var IAccessRightPresenter
		 */
		private $presenter;
		/**
		 * @var \Saigon\TeamMate\Business\Contract\Interactor\ICreateUser
		 */
		private $createUser;
		/**
		 * @var ICreateUserAccessRightLogger
		 */
		private $logger;

		function __construct(
			IAccessRightDao $dao,
			IAccessRightPresenter $presenter,
			ICreateUser $createUser,
			ICreateUserAccessRightLogger $logger
		)
		{
			$this->dao = $dao;
			$this->presenter = $presenter;
			$this->createUser = $createUser;
			$this->logger = $logger;
		}

		function run(ICreateUserRequestData $data)
		{
			$hasAccessRight = $this->dao->hasAccessRight(self::CREATE_USER_ACCESS_RIGHT);
			if (!$hasAccessRight)
				$this->showAccessDenied();
			else
				$this->createUser->run($data);
		}

		protected function showAccessDenied() {
			$this->logger->logAccessDenied();
			$this->presenter->showAccessDenied();
		}
	}