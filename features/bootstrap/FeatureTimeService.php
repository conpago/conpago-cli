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
		protected $date;

		/**
		 * @return DateTime
		 */
		function getCurrentTime() {
			return $this->date;
		}

		function setTime(DateTime $date)
		{
				$this->date = $date;
		}
	}