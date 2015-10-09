<?php
	/**
	 * Created by PhpStorm.
	 * User: bartosz.golek
	 * Date: 2014-05-23
	 * Time: 08:29
	 */

	namespace Saigon\TeamMate\Business\Logger;


	use Saigon\TeamMate\Business\Contract\Logger\IAccessRightDeniedLogger;
	use Saigon\TeamMate\Business\Contract\Logger\ICreateUserAccessRightLogger;
	use Saigon\TeamMate\Business\Interactor\CreateUserAccessRight;

	class CreateUserAccessRightLogger implements ICreateUserAccessRightLogger
	{
		/**
		 * @var IAccessRightDeniedLogger
		 */
		private $logger;

		function __construct(IAccessRightDeniedLogger $logger) {
			$this->logger = $logger;
		}

		public function logAccessDenied() {
			$this->logger->log(CreateUserAccessRight::CREATE_USER_ACCESS_RIGHT);
		}
	}