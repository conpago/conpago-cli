<?php
	/**
	 * Created by PhpStorm.
	 * User: bartosz.golek
	 * Date: 2014-05-23
	 * Time: 08:29
	 */

	namespace Saigon\TeamMate\Business\Contract\Logger;

	interface ICreateUserAccessRightLogger
	{
		public function logAccessDenied();
	}