<?php
	namespace Saigon\TeamMate\Business\Interactor;

	use Conpago\Database\Exceptions\ColumnUniqueConstraintException;
	use Conpago\Exceptions\Exception;
	use Conpago\Helpers\Contract\IPasswordHasher;
	use Saigon\TeamMate\Business\Contract\Dao\ICreateUserDao;
	use Saigon\TeamMate\Business\Contract\Interactor\ICreateUser;
	use Saigon\TeamMate\Business\Contract\Logger\ICreateUserLogger;
	use Saigon\TeamMate\Business\Contract\Model\IUser;
	use Saigon\TeamMate\Business\Contract\Presenter\ICreateUserPresenter;
	use Saigon\TeamMate\Business\Contract\PresenterModel\ICreateUserPresenterModel;
	use Saigon\TeamMate\Business\Contract\RequestData\ICreateUserRequestData;
	use Saigon\TeamMate\Business\Validators\CreateUserRequestDataValidator;
	use Saigon\TeamMate\Business\PresenterModel\CreateUserPresenterModel;

	class CreateUser implements ICreateUser
	{
		const FIELD_USERNAME_HAVE_TO_BE_UNIQUE = "Field Username have to be unique.";
		const FIELD_EMAIL_HAVE_TO_BE_UNIQUE = "Field Email have to be unique.";
		const FIELD_NICK_HAVE_TO_BE_UNIQUE = "Field Nick have to be unique.";
		const CANNOT_HANDLE_UNIQUE_EXCEPTION_FOR_COLUMN = "Cannot handle UniqueException for column: ";

		/**
		 * @var ICreateUserDao
		 */
		private $dao;
		/**
		 * @var IPasswordHasher
		 */
		private $passwordHasher;
		/**
		 * @var CreateUserRequestDataValidator
		 */
		private $userValidator;
		/**
		 * @var ICreateUserPresenter
		 */
		private $presenter;
		/**
		 * @var ICreateUserLogger
		 */
		private $logger;

		function __construct(ICreateUserDao $dao,
			ICreateUserPresenter $presenter,
			IPasswordHasher $passwordHasher,
			CreateUserRequestDataValidator $userValidator,
			ICreateUserLogger $logger)
		{
			$this->dao = $dao;
			$this->presenter = $presenter;
			$this->passwordHasher = $passwordHasher;
			$this->userValidator = $userValidator;
			$this->logger = $logger;
		}

		/**
		 * @param ICreateUserRequestData $data
		 */
		public function run(ICreateUserRequestData $data)
		{
			$validationResult = $this->validate($data);

			if (!$validationResult->isValidationPassed())
				$this->presenter->showValidationFailed($validationResult);
			else
				$this->trySaveUser($data);
		}

		/**
		 * @param ColumnUniqueConstraintException $exception
		 *
		 * @return string
		 */
		protected function getMessageFromUniqueException(ColumnUniqueConstraintException $exception)
		{
			switch ($exception->columnName)
			{
				case 'username':
					return self::FIELD_USERNAME_HAVE_TO_BE_UNIQUE;
				case 'email':
					return self::FIELD_EMAIL_HAVE_TO_BE_UNIQUE;
				case 'nickname':
					return self::FIELD_NICK_HAVE_TO_BE_UNIQUE;
				default :
					throw new Exception(self::CANNOT_HANDLE_UNIQUE_EXCEPTION_FOR_COLUMN . $exception->columnName);
			}
		}

		private function validate($data)
		{
			return $this->userValidator->validate($data);
		}

		/**
		 * @param ICreateUserRequestData $data
		 *
		 * @return IUser
		 */
		private function buildUser(ICreateUserRequestData $data)
		{
			$userBuilder = new UserBuilder();

			return $userBuilder
				->withUsername($data->getUsername())
				->withPassword($this->passwordHasher->getHash($data->getPassword()))
				->withEmail($data->getEmail())
				->withNickname($data->getNickname())
				->build($this->dao->createUser());
		}

		/**
		 * @param IUser $user
		 */
		private function saveUser($user)
		{
			$this->dao->saveUser($user);
			$this->presenter->showUserCreated($this->buildCreateUserPresenterModel($user));
		}

		/**
		 * @param ICreateUserRequestData $data
		 */
		private function trySaveUser(ICreateUserRequestData $data)
		{
			try
			{
				$this->saveUser($this->buildUser($data));
			}
			catch (ColumnUniqueConstraintException $e)
			{
				$this->presenter->showFailed($this->getMessageFromUniqueException($e));
			}
		}

		/**
		 * @param IUser $user
		 *
		 * @return ICreateUserPresenterModel
		 */
		private function buildCreateUserPresenterModel(IUser $user)
		{
			$presenterModel = new CreateUserPresenterModel();
			$presenterModel->setUserId($user->getId());
			$presenterModel->setUsername($user->getUsername());
			$presenterModel->setNickname($user->getNickname());
			$presenterModel->setEmail($user->getEmail());
			return $presenterModel;
		}
	}

	class UserBuilder
	{
		private $username;
		private $password;
		private $email;
		private $nickname;

		/**
		 * @param $username
		 *
		 * @return $this
		 */
		function withUsername($username)
		{
			$this->username = $username;
			return $this;
		}

		/**
		 * @param $password
		 *
		 * @return $this
		 */
		function withPassword($password)
		{
			$this->password = $password;
			return $this;
		}

		/**
		 * @param $email
		 *
		 * @return $this
		 */
		function withEmail($email)
		{
			$this->email = $email;
			return $this;
		}

		/**
		 * @param $nickname
		 *
		 * @return $this
		 */
		function withNickname($nickname)
		{
			$this->nickname = $nickname;
			return $this;
		}

		/**
		 * @param IUser $user
		 *
		 * @return \Saigon\TeamMate\Business\Contract\Model\IUser
		 */
		function build(IUser $user)
		{
			$user->setUsername($this->username);
			$user->setPassword($this->password);
			$user->setEmail($this->email);
			$user->setNickname($this->nickname);

			return $user;
		}
	}