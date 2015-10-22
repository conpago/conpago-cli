Feature: interactor
  In order to generate interactor with surroundings
  As an commandline user
  I need to be able to run cli command 'interactor'

  Scenario: Create simple interactor
    Given Current date is '29.10.13'
    Given Current time is '08:43'
    Given Config file exists:
      """
      author: "Bartosz Gołek"
      company: "TestCompany"
      project: "TestApp"
      sources: "tmp/src"
      tests: "tmp/tests"
      """
    Given The files are not exists:
      """
      ./tmp/src/TestCompany/TestApp/Modules/TestInteractorModule.php
      ./tmp/src/TestCompany/TestApp/Business/Contract/Dao/ITestInteractorDao.php
      ./tmp/src/TestCompany/TestApp/Dao/Business/TestInteractorDao.php
      ./tmp/src/TestCompany/TestApp/Presentation/Contract/Controller/ITestInteractorController.php
      ./tmp/src/TestCompany/TestApp/Presentation/Controller/TestInteractorController.php
      ./tmp/src/TestCompany/TestApp/Business/Contract/Presenter/ITestInteractorPresenter.php
      ./tmp/src/TestCompany/TestApp/Presentation/Presenter/TestInteractorPresenter.php
      ./tmp/src/TestCompany/TestApp/Business/Contract/Interactor/ITestInteractor.php
      ./tmp/src/TestCompany/TestApp/Business/Interactor/TestInteractor.php
      ./tmp/src/TestCompany/TestApp/Business/Contract/RequestData/ITestInteractorRequestData.php
      ./tmp/src/TestCompany/TestApp/Presentation/RequestData/TestInteractorRequestData.php
      ./tmp/src/TestCompany/TestApp/Business/Contract/PresenterModel/ITestInteractorPresenterModel.php
      ./tmp/src/TestCompany/TestApp/Business/PresenterModel/TestInteractorPresenterModel.php
      ./tmp/src/TestCompany/TestApp/Business/Contract/PresenterModel/ITestInteractorValidationResult.php
      ./tmp/src/TestCompany/TestApp/Business/PresenterModel/TestInteractorValidationResult.php
      ./tmp/src/TestCompany/TestApp/Business/Contract/Logger/ITestInteractorLogger.php
      ./tmp/src/TestCompany/TestApp/Business/Logger/TestInteractorLogger.php
      ./tmp/src/TestCompany/TestApp/Business/Contract/Validators/ITestInteractorRequestDataValidator.php
      ./tmp/src/TestCompany/TestApp/Business/Validators/TestInteractorRequestDataValidator.php
      ./tmp/src/TestCompany/TestApp/Business/Contract/Logger/ITestInteractorAccessRightLogger.php
      ./tmp/src/TestCompany/TestApp/Business/Interactor/TestInteractorAccessRight.php
      ./tmp/src/TestCompany/TestApp/Business/Contract/Logger/ITestInteractorAccessRightLogger.php
      ./tmp/src/TestCompany/TestApp/Business/Logger/TestInteractorAccessRightLogger.php
      """

    When I run 'interactor' cli command
    When I answer 'y' to question 'Create access right?'
    When I answer 'y' to question 'Create request data?'
    When I answer 'y' to question 'Create validator?'
    When I answer 'y' to question 'Create dao?'
    When I answer 'y' to question 'Create logger?'
    When I answer 'y' to question 'Create presenter model?'
    When I answer 'y' to question 'Create Conpago/DI modules?'
    Then File './tmp/src/TestCompany/TestApp/Modules/TestInteractorModule.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace TestCompany\TestApp\Business\Modules;

	use Conpago\DI\IContainerBuilder;
	use Conpago\DI\Parameter;
	use Conpago\DI\IModule;

	class TestInteractorModule implements IModule
	{

		/**
		 * @param IContainerBuilder $builder
		 *
		 * @SuppressWarnings(PHPMD.StaticAccess)
		 */
		public function build(IContainerBuilder $builder)
		{
			$builder->registerType('TestCompany\TestApp\Presentation\Controller\TestInteractorController')
				->asA('Conpago\IController')
				->asA('TestCompany\TestApp\Presentation\Contract\Controller\ITestInteractorController')
				->keyed('TestInteractorController')
				->singleInstance();

			$builder->registerType('TestCompany\TestApp\Business\Interactor\TestInteractor')
				->asA('TestCompany\TestApp\Business\Contract\Interactor\ITestInteractor')
				->named('TestInteractor')
				->singleInstance();

			$builder->registerType('TestCompany\TestApp\Business\Interactor\TestInteractorAccessRight')
				->withParams(Parameter::def(), Parameter::def(), Parameter::named('TestInteractor'))
				->asA('TestCompany\TestApp\Business\Contract\Interactor\ITestInteractor')
				->singleInstance();

			$builder->registerType('TestCompany\TestApp\Presentation\Presenter\TestInteractorPresenter')
				->asA('TestCompany\TestApp\Business\Contract\Presenter\ITestInteractorPresenter')
				->singleInstance();

			$builder->registerType('TestCompany\TestApp\Dao\Business\TestInteractorDao')
				->asA('TestCompany\TestApp\Business\Contract\Dao\ITestInteractorDao')
				->singleInstance();

			$builder->registerType('Saigon\TeamMate\Business\Validators\CreateUserRequestDataValidator')
					->asA('Saigon\TeamMate\Business\Contract\Validators\ICreateUserRequestDataValidator');

			$builder->registerType('TestCompany\TestApp\Business\Logger\TestInteractorLogger')
			        ->asA('TestCompany\TestApp\Business\Contract\Logger\ITestInteractorLogger')
			        ->singleInstance();

			$builder->registerType('TestCompany\TestApp\Business\Logger\TestInteractorAccessRightLogger')
			        ->asA('TestCompany\TestApp\Business\Contract\Logger\ITestInteractorAccessRightLogger')
			        ->singleInstance();
		}
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Contract/Dao/ITestInteractorDao.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace TestCompany\TestApp\Business\Contract\Dao;

	interface ICreateUserDao
	{
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Dao/Business/TestInteractorDao.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace TestCompany\TestApp\Dao\Business;

	use TestCompany\TestApp\Business\Contract\Dao\ITestInteractorDao;

	class TestInteractorDao implements ITestInteractorDao
	{
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Presentation/Contract/Controller/ITestInteractorController.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace TestCompany\TestApp\Presentation\Contract\Controller;

	use Conpago\Helpers\Contract\IRequestData;
	use Conpago\Presentation\Contract\IController;

	interface ICreateUserController extends IController
	{
		function execute(IRequestData $data);
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Presentation/Controller/TestInteractorController.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Presentation\Controller;


	use Conpago\Exceptions\Http400BadRequestException;
	use Conpago\Helpers\Contract\IRequestData;
	use Saigon\TeamMate\Presentation\Contract\Controller\ICreateUserController;
	use Saigon\TeamMate\Business\Contract\Interactor\ICreateUser;
	use Saigon\TeamMate\Presentation\RequestData\CreateUserRequestData;

	class CreateUserController implements ICreateUserController
	{
		/**
		 * @var \Saigon\TeamMate\Business\Contract\Interactor\ICreateUser
		 */
		private $createUser;

		function __construct(ICreateUser $createUser)
		{
			$this->createUser = $createUser;
		}

		function execute(IRequestData $data)
		{
			$parameters = $data->getParameters();

			if ($parameters == null)
				throw new Http400BadRequestException("");

            //TODO: Repalce ?entity? with right name
            if (!array_key_exists('?entity?', $parameters)
            	throw new Http400BadRequestException("");

			$requestData = new CreateUserRequestData(
				//TODO: set request data fields as below
				//$parameters['?entity?']['?field?']
			);
			$this->createUser->run($requestData);
		}
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Contract/Presenter/ITestInteractorPresenter.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Business\Contract\Presenter;

	use Saigon\TeamMate\Business\Contract\PresenterModel\ICreateUserPresenterModel;
	use Saigon\TeamMate\Business\Contract\PresenterModel\ICreateUserValidationResult;

	interface ICreateUserPresenter
	{
		public function showValidationFailed(ICreateUserValidationResult $validationResult);

		public function showCreateUserSucceed(ICreateUserPresenterModel $data);

		public function showFailed($message);
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Presentation/Presenter/TestInteractorPresenter.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace TestCompany\TestApp\Presentation\Presenter;


	use Conpago\Presentation\Contract\IJsonPresenter;
	use TestCompany\TestApp\Business\Contract\Presenter\ICreateUserPresenter;
	use TestCompany\TestApp\Business\Contract\PresenterModel\ICreateUserPresenterModel;
	use TestCompany\TestApp\Business\Contract\PresenterModel\ICreateUserValidationResult;

	class CreateUserPresenter implements ICreateUserPresenter
	{
		const FAIL_MEESAGE = '?FAIL_MEESAGE?';
		const SUCCEED_MEESAGE = "?SUCCEED_MEESAGE?";

		/**
		 * @var IJsonPresenter
		 */
		private $jsonPresenter;

		function __construct(IJsonPresenter $jsonPresenter)
		{
			$this->jsonPresenter = $jsonPresenter;
		}

		public function showValidationFailed(ICreateUserValidationResult $validationResult)
		{
			$data['success'] = false;
			//TODO: set validation output as bellow
			//$data['validation']['field'] = $validationResult->getFieldMessage();
			$data['message'] = self::FAIL_MEESAGE;
			$this->jsonPresenter->showJson($data);
		}

		public function showCreateUserSucceed(ICreateUserPresenterModel $data)
		{
			$jsonData['success'] = true;
			$jsonData['message'] = self::SUCCEED_MEESAGE;
			//TODO: set output output as bellow
			$jsonData['entity']['field'] = $data->getField();
			$this->jsonPresenter->showJson($jsonData);
		}

		public function showFailed($message)
		{
			$data['success'] = false;
			$data['message'] =  $message . ' ' . self::FAIL_MEESAGE;
			$this->jsonPresenter->showJson($data);
		}
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Contract/Interactor/ITestInteractor.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
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
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Interactor/TestInteractor.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

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
	use Saigon\TeamMate\Business\Contract\Validators\ICreateUserRequestDataValidator;
	use Saigon\TeamMate\Business\PresenterModel\CreateUserPresenterModel;

	class CreateUser implements ICreateUser
	{
		/**
		 * @var ICreateUserDao
		 */
		private $dao;
		/**
		 * @var ICreateUserRequestDataValidator
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

		function __construct(
			ICreateUserDao $dao,
			ICreateUserPresenter $presenter,
			ICreateUserRequestDataValidator $userValidator,
			ICreateUserLogger $logger)
		{
			$this->dao = $dao;
			$this->presenter = $presenter;
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
				$this->doCreateUser($data);
		}

		/**
		 * @param ColumnUniqueConstraintException $exception
		 *
		 * @return string
		 * @throws Exception
		 */
		protected function getMessageFromUniqueException(ColumnUniqueConstraintException $exception)
		{
			switch ($exception->columnName)
			{
				//TODO: handle columns with propper messages as below
				//case '?field_name?':
				//	return self::?FIELD_??_HAVE_TO_BE_UNIQUE?;
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
		 */
		private function trySaveUser(ICreateUserRequestData $data)
		{
			try
			{
				//TODO: do things and create request model
				$this->presenter->showCreateUserSucceed(?entity?);
			}
			catch (ColumnUniqueConstraintException $e)
			{
				$this->presenter->showFailed($this->getMessageFromUniqueException($e));
			}
		}
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Contract/RequestData/ITestInteractorRequestData.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Business\Contract\RequestData;

	interface ICreateUserRequestData
	{
		//TODO: create getters as bellow
		/** @return string */
		//function getField();
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Presentation/RequestData/TestInteractorRequestData.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Presentation\RequestData;

	use Saigon\TeamMate\Business\Contract\RequestData\ICreateUserRequestData;

	class CreateUserRequestData implements ICreateUserRequestData
	{
		//TODO: create fields as below
		//private $field;

		function __construct(
			//TODO: create parameter for every field as below
			//$field
		)
		{
			//TODO: assign fields as below
			//$this->field = $field;
		}

		//TODO: create getters as bellow
		/** @return string */
		//function getField()
		//{
		//	return $this->field;
		//}
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Contract/PresenterModel/ITestInteractorPresenterModel.php' exists with following content:
    """
    <?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Business\Contract\PresenterModel;

	interface ICreateUserPresenterModel
	{
		//TODO: create getters as bellow
		/** @return string */
		//function getField();
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/PresenterModel/TestInteractorPresenterModel.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Business\PresenterModel;

	use Saigon\TeamMate\Business\Contract\PresenterModel\ICreateUserPresenterModel;

	class CreateUserPresenterModel implements ICreateUserPresenterModel
	{
		//TODO: create fields as below
		//private $field;

		function __construct(
			//TODO: create parameter for every field as below
			//$field
		)
		{
			//TODO: assign fields as below
			//$this->field = $field;
		}

		//TODO: create getters as bellow
		/** @return string */
		//function getField()
		//{
		//	return $this->field;
		//}
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Contract/PresenterModel/ITestInteractorValidationResult.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Business\Contract\PresenterModel;

	use Conpago\Contract\IValidationResult;

	interface ICreateUserValidationResult extends IValidationResult
	{
		//TODO: create message getters as bellow
		/** @return string */
		//function getFieldMessage();
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/PresenterModel/TestInteractorValidationResult.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Business\PresenterModel;

	use Saigon\TeamMate\Business\Contract\PresenterModel\ICreateUserValidationResult;

	class CreateUserValidationResult implements ICreateUserValidationResult
	{
		//TODO: create fields as below
		//private $fieldMessage;

		function __construct(
			//TODO: create parameter for every field as below
			//$fieldMessage
		)
		{
			//TODO: assign fields as below
			//$this->fieldMessage = $fieldMessage;
		}

		//TODO: create getters as bellow
		/** @return string */
		//function getFieldMessage()
		//{
		//	return $this->fieldMessage;
		//}

		/**
		 * @return bool
		 */
		function isValidationPassed()
		{
			$isValid = true;
			//TODO: check results as below
			$isValid = $isValid && $this->isNullOrEmpty($this->fieldMessage);

			return $isValid;
		}

		/**
		 * @param $string
		 *
		 * @return bool
		 */
		private function isNullOrEmpty($string)
		{
			return $string == null || $string == "";
		}
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Contract/Logger/ITestInteractorLogger.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Business\Contract\Logger;

	interface ICreateUserLogger
	{
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Logger/TestInteractorLogger.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Business\Logger;


	use Saigon\TeamMate\Business\Contract\Logger\ICreateUserLogger;

	class CreateUserLogger implements ICreateUserLogger
	{
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Contract/Validators/ITestInteractorRequestDataValidator.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Business\Contract\Validators;


	use Saigon\TeamMate\Business\Contract\PresenterModel\ICreateUserValidationResult;
	use Saigon\TeamMate\Business\Contract\RequestData\ICreateUserRequestData;

	interface ICreateUserRequestDataValidator {

		/**
		 * @param ICreateUserRequestData $requestData
		 *
		 * @return ICreateUserValidationResult
		 */
		function validate(ICreateUserRequestData $requestData);
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Validators/TestInteractorRequestDataValidator.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Business\Validators;


	use Saigon\TeamMate\Business\Contract\RequestData\ICreateUserRequestData;
	use Saigon\TeamMate\Business\Contract\Validators\ICreateUserRequestDataValidator;
	use Saigon\TeamMate\Business\PresenterModel\CreateUserValidationResult;

	class CreateUserRequestDataValidator implements ICreateUserRequestDataValidator
	{
		//TODO: create validation result messages as below
		//const ??_FIELD_IS_REQUIRED = "?? field is required";

		function validate(ICreateUserRequestData $requestData)
		{
			return new CreateUserValidationResult(
				//TODO: add result messages as below
				//$this->checkFieldRequired($requestData->getField()),
			);
		}

        //TODO: create cecking methods as below
		//private function checkFieldRequired($password)
		//{
		//	return !$this->isNotEmpty($password)
		//		? self::??_FIELD_IS_REQUIRED
		//		: "";
		//}

		private function isNotEmpty($string)
		{
			return $string != null && $string != "";
		}
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Contract/Logger/ITestInteractorAccessRightLogger.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Business\Contract\Logger;

	interface ICreateUserAccessRightLogger
	{
		public function logAccessDenied();
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Logger/TestInteractorAccessRightLogger.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
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
			$this->logger->log(CreateUserAccessRight::TEST_INTERACTOR_ACCESS_RIGHT);
		}
	}
    """
    Then File './tmp/src/TestCompany/TestApp/Business/Interactor/TestInteractorAccessRight.php' exists with following content:
    """
<?php
	/**
	 * Created by Conpago-Cli.
	 * User: Bartosz Gołek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Business\Interactor;


	use Conpago\AccessRight\Contract\IAccessRightDao;
	use Conpago\AccessRight\Contract\IAccessRightPresenter;
	use Saigon\TeamMate\Business\Contract\Interactor\ICreateUser;
	use Saigon\TeamMate\Business\Contract\Logger\ICreateUserAccessRightLogger;
	use Saigon\TeamMate\Business\Contract\RequestData\ICreateUserRequestData;

	class CreateUserAccessRight implements ICreateUser
	{
		const TEST_INTERACTOR_ACCESS_RIGHT = "CreateUserAccessRight";

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
		private $interactor;
		/**
		 * @var ICreateUserAccessRightLogger
		 */
		private $logger;

		function __construct(
			IAccessRightDao $dao,
			IAccessRightPresenter $presenter,
			ICreateUser $interactor,
			ICreateUserAccessRightLogger $logger
		)
		{
			$this->dao = $dao;
			$this->presenter = $presenter;
			$this->interactor = $interactor;
			$this->logger = $logger;
		}

		function run(ICreateUserRequestData $data)
		{
			$hasAccessRight = $this->dao->hasAccessRight(self::CREATE_USER_ACCESS_RIGHT);
			if (!$hasAccessRight)
				$this->showAccessDenied();
			else
				$this->interactor->run($data);
		}

		protected function showAccessDenied() {
			$this->logger->logAccessDenied();
			$this->presenter->showAccessDenied();
		}
	}
    """