<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 05.11.15
	 * Time: 23:51
	 */

	/**
	 *
	 * @license MIT
	 * @author Bartosz Gołek <bartosz.golek@gmail.com>
	 **/
	class FeatureApplicationFactory extends \Conpago\Cli\ApplicationFactory {

		function __construct(\Conpago\Contract\ITimeService $timeService) {
			$this->timeService = $timeService;
		}

		function createConfig()
		{
			return new FeatureYamlConfig();
		}
	}