<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-03-29
	 * Time: 11:36
	 */

	namespace Saigon\TeamMate\Business\Contract\RequestData;

	interface ICreateUserRequestData
	{
		/** @return string */
		function getUsername();

		/** @return string */
		function getPassword();

		/** @return string */
		function getPasswordConfirmation();

		/** @return string */
		function getEmail();

		/** @return string */
		function getNickname();
	}