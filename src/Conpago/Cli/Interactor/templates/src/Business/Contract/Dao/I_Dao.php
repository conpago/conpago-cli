<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-03-29
	 * Time: 13:16
	 */

	namespace Saigon\TeamMate\Business\Contract\Dao;

	use Saigon\TeamMate\Business\Contract\Model\IUser;

	interface ICreateUserDao
	{
		/**
		 * @param IUser $user
		 *
		 * @return void
		 */
		public function saveUser(IUser $user);

		/**
		 * @return IUser
		 */
		public function createUser();
	}