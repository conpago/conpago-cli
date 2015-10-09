<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-05-20
	 * Time: 23:07
	 */

	namespace Saigon\TeamMate\Presentation\Contract\Controller;

	use Conpago\Helpers\Contract\IRequestData;
	use Conpago\Presentation\Contract\IController;

	interface ICreateUserController extends IController
	{
		function execute(IRequestData $data);
	}