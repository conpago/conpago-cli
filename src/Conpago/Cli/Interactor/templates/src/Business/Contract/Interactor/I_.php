<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-03-29
	 * Time: 11:36
	 */

	namespace Saigon\TeamMate\Business\Contract\Interactor;

	use Saigon\TeamMate\Business\Contract\RequestData\ICreateUserRequestData;

	interface ICreateUser
	{
		/**
		 * @param ICreateUserRequestData $data
		 */
		public function run(ICreateUserRequestData $data);
	}