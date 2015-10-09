<?php
	namespace Saigon\TeamMate\Business\PresenterModel;

	use Saigon\TeamMate\Business\Contract\PresenterModel\ICreateUserPresenterModel;

	class CreateUserPresenterModel implements ICreateUserPresenterModel
	{
		/**
		 * @var int
		 */
		private $userId;
		/**
		 * @var string
		 */
		private $username;
		/**
		 * @var string
		 */
		private $email;
		/**
		 * @var string
		 */
		private $nickname;

		/**
		 * @param int $userId
		 */
		public function setUserId($userId)
		{
			$this->userId = $userId;
		}

		/**
		 * @param string $username
		 */
		public function setUsername($username)
		{
			$this->username = $username;
		}

		/**
		 * @param string $email
		 */
		public function setEmail($email)
		{
			$this->email = $email;
		}

		/**
		 * @param string $nickname
		 */
		public function setNickname($nickname)
		{
			$this->nickname = $nickname;
		}

		/** @return int */
		function getUserId()
		{
			return $this->userId;
		}

		/** @return string */
		function getUsername()
		{
			return $this->username;
		}

		/** @return string */
		function getEmail()
		{
			return $this->email;
		}

		/** @return string */
		function getNickname()
		{
			return $this->nickname;
		}
	}