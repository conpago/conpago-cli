<?php

	namespace Saigon\TeamMate\Business\Contract\PresenterModel;

	interface ICreateUserPresenterModel
	{
		/** @return int */
		function getUserId();

		/** @return string */
		function getUsername();

		/** @return string */
		function getEmail();

		/** @return string */
		function getNickname();
	}