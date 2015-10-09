<?php
	/**
	 * Created by PhpStorm.
	 * User: bartosz.golek
	 * Date: 2014-05-22
	 * Time: 08:41
	 */

	namespace Saigon\TeamMate\Presentation\Presenter;


	use Conpago\Presentation\Contract\IJsonPresenter;
	use Saigon\TeamMate\Business\Contract\Presenter\ICreateUserPresenter;
	use Saigon\TeamMate\Business\Contract\PresenterModel\ICreateUserPresenterModel;
	use Saigon\TeamMate\Business\Contract\PresenterModel\ICreateUserValidationResult;

	class CreateUserPresenter implements ICreateUserPresenter
	{
		const USER_HAS_NOT_BEEN_SAVED = 'User has not been saved.';
		const USER_HAS_BEEN_CREATED = "User has been created.";

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
			$data['validation']['nickname'] = $validationResult->getNicknameMessage();
			$data['validation']['username'] = $validationResult->getUsernameMessage();
			$data['validation']['password'] = $validationResult->getPasswordMessage();
			$data['validation']['password_confirmation'] = $validationResult->getPasswordConfirmationMessage();
			$data['validation']['email'] = $validationResult->getEmailMessage();
			$data['message'] = self::USER_HAS_NOT_BEEN_SAVED;
			$this->jsonPresenter->showJson($data);
		}

		public function showUserCreated(ICreateUserPresenterModel $data)
		{
			$jsonData['success'] = true;
			$jsonData['message'] = self::USER_HAS_BEEN_CREATED;
			$jsonData['user']['id'] = $data->getUserId();
			$jsonData['user']['nickname'] = $data->getNickname();
			$jsonData['user']['username'] = $data->getUsername();
			$jsonData['user']['email'] = $data->getEmail();
			$this->jsonPresenter->showJson($jsonData);
		}

		public function showFailed($message)
		{
			$data['success'] = false;
			$data['message'] =  $message . ' ' . self::USER_HAS_NOT_BEEN_SAVED;
			$this->jsonPresenter->showJson($data);
		}
	}