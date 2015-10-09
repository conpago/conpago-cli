<?php
	/**
	 * Created by PhpStorm.
	 * User: bartosz.golek
	 * Date: 2014-05-23
	 * Time: 08:32
	 */

	namespace Saigon\TeamMate\Dao\Business;

	use Saigon\TeamMate\Business\Contract\Dao\ICreateUserDao;
	use Saigon\TeamMate\Business\Contract\Model\IUser;
	use Saigon\TeamMate\Dao\Contract\IUserDao;

	class CreateUserDao implements ICreateUserDao
	{
		/**
		 * @var IUserDao
		 */
		private $userDao;

		function __construct(IUserDao $userDao)
		{
			$this->userDao = $userDao;
		}

		/**
		 * @param IUser $user
		 *
		 * @return void
		 */
		public function saveUser(IUser $user)
		{
			$this->userDao->insert($user);
		}

		/**
		 * @return IUser
		 */
		public function createUser()
		{
			return $this->userDao->createUser();
		}
	}