<?php
	/**
	 * Created by PhpStorm.
	 * User: bartosz.golek
	 * Date: 29.10.13
	 * Time: 08:43
	 */

	namespace Saigon\TeamMate\Modules\Users;

	use Conpago\DI\IContainerBuilder;
	use Conpago\DI\Parameter;
	use Conpago\DI\IModule;

	class CreateUserModule implements IModule
	{

		/**
		 * @param IContainerBuilder $builder
		 *
		 * @SuppressWarnings(PHPMD.StaticAccess)
		 */
		public function build(IContainerBuilder $builder)
		{
			$builder->registerType('Saigon\TeamMate\Presentation\Controller\CreateUserController')
				->asA('Conpago\IController')
				->asA('Saigon\TeamMate\Presentation\Contract\Controller\ICreateUserController')
				->keyed('CreateUserController')
				->singleInstance();

			$builder->registerType('Saigon\TeamMate\Business\Interactor\CreateUser')
				->asA('Saigon\TeamMate\Business\Contract\Interactor\ICreateUser')
				->named('CreateUser')
				->singleInstance();

			$builder->registerType('Saigon\TeamMate\Business\Interactor\CreateUserAccessRight')
				->withParams(Parameter::def(), Parameter::def(), Parameter::named('CreateUser'))
				->asA('Saigon\TeamMate\Business\Contract\Interactor\ICreateUser')
				->singleInstance();

			$builder->registerType('Saigon\TeamMate\Presentation\Presenter\CreateUserPresenter')
				->asA('Saigon\TeamMate\Business\Contract\Presenter\ICreateUserPresenter')
				->singleInstance();

			$builder->registerType('Saigon\TeamMate\Dao\Business\CreateUserDao')
				->asA('Saigon\TeamMate\Business\Contract\Dao\ICreateUserDao')
				->singleInstance();

			$builder->registerType('Saigon\TeamMate\Business\Validators\CreateUserRequestDataValidator');

			$builder->registerType('Saigon\TeamMate\Business\Logger\CreateUserLogger')
			        ->asA('Saigon\TeamMate\Business\Contract\Logger\ICreateUserLogger')
			        ->singleInstance();

			$builder->registerType('Saigon\TeamMate\Business\Logger\CreateUserAccessRightLogger')
			        ->asA('Saigon\TeamMate\Business\Contract\Logger\ICreateUserAccessRightLogger')
			        ->singleInstance();
		}
	}