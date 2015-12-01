<?php
	/**
	 * Created by PhpStorm.
	 * User: bg
	 * Date: 05.11.15
	 * Time: 23:49
	 */

	/**
	 *
	 * @license MIT
	 * @author Bartosz Gołek <bartosz.golek@gmail.com>
	 **/
	class FeatureTimeService implements \Conpago\Contract\ITimeService {
		/**
		 * @var DateTime
		 */
		protected $date;

		function __construct() {
			$this->date = new DateTime();
		}

		/**
		 * @return DateTime
		 */
		function getCurrentTime() {
			return $this->date;
		}

		/**
		 * @param string $time Required format 'hh:mm[:ss]'
		 */
		function setTime($time)
		{
			$timeParts = explode(':', $time);
			$hour = $timeParts[0];
			$min = $timeParts[1];
			$sec = 0;
			if (count($timeParts) > 2){
				$sec = $timeParts[2];
			}
			$this->date->setTime($hour, $min, $sec);
		}

		/**
		 * @param string $date Required format 'YYYY-MM-DD'
		 */
		function setDate($date)
		{
			$dateParts = explode('-', $date);
			$year = $dateParts[0];
			$month = $dateParts[1];
			$day = $dateParts[2];

			$this->date->setTime($year, $month, $day);
		}
	}