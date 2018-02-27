<?php
/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 05/02/2018
 * Time: 11:11
 */

namespace share\SharePress\Helpers;


class Dates
{
	public function parseAndFormatDate ($dateStr) {
		$dateParsed = new \DateTime(str_replace('/', '-', $dateStr));
		return (object) [
			'date' => $dateParsed,
			'formatted' => $dateParsed->format("Y-m-d")
		];
	}

	public function calculateAge (\DateTime $date, $from = null) {
		$from = $from === null ? new \DateTime() : $from;
		$interval     = $from->diff($date);
		return $interval->y;
	}
}