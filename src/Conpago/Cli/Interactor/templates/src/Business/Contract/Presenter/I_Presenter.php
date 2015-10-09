<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-03-29
	 * Time: 11:36
	 */

	namespace Saigon\TeamMate\Business\Contract\Presenter;

	use Saigon\TeamMate\Business\Contract\PresenterModel\ICreateUserPresenterModel;
	use Saigon\TeamMate\Business\Contract\PresenterModel\ICreateUserValidationResult;

	interface ICreateUserPresenter
	{
		public function showValidationFailed(ICreateUserValidationResult $validationResult);

		public function showUserCreated(ICreateUserPresenterModel $data);

		public function showFailed($message);
	}