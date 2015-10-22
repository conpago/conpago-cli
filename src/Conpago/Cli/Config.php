<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 19.10.15
	 * Time: 23:28
	 */

	namespace Conpago\Cli;


	use Conpago\Cli\Contract\IConfig;
	use Symfony\Component\Yaml\Yaml;

	class Config implements IConfig {

		/**
		 * @var array
		 */
		protected $config = array();

		function __construct($filePath)
		{
			if (file_exists($filePath) && is_file($filePath))
			{
				$this->config = Yaml::parse($filePath);
			}
		}

		function getValue($path)
		{
			$pathArray = explode('.', $path);
			$currentElement = $this->config;

			foreach ($pathArray as $currentName)
			{
				if (!array_key_exists($currentName, $currentElement))
					throw new MissingConfigurationException($path);

				$currentElement = $currentElement[$currentName];
			}

			return $currentElement;
		}

		/**
		 * @param $path
		 *
		 * @return bool
		 */
		function hasValue( $path ) {
			$pathArray = explode('.', $path);
			$currentElement = $this->config;

			foreach ($pathArray as $currentName)
			{
				if (!array_key_exists($currentName, $currentElement))
					return false;

				$currentElement = $currentElement[$currentName];
			}

			return true;
		}
	}