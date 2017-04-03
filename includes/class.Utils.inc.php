<?php
/*
 *	Class Utils - few helper functions/debuggers/formatters
 */


class Utils{

	/**
	 * Displays the array.
	 * @param Array $aArr
	 * @echo String
	 */
	static public function PrintArray($aArr)
	{
		echo '<pre>' . print_r($aArr, true) . '</pre>';
	}
	
	/**
	 * Checks the value and get it in an array by index.
	 * @param mixed $aMixIndex
	 * @param Array $aArr
	 * @param mixed $aReturnDefault
	 * @return mixed
	 */
	static public function GetValueByIndex($aMixIndex, $aArr, $aMixReturnDefault = null)
	{	
		if (true == isset($aArr[$aMixIndex]))
		{
			return $aArr[$aMixIndex];
		}
		
		return $aMixReturnDefault;
	}
		
	/**
	 * Sets the date to ISO8601 compliant date.
	 * @param String $aStrDate
	 * @return String
	 */
	static public function DateCompliantFormat($aStrDate)
	{
		$datetime = new DateTime($aStrDate);
		return $datetime->format(DateTime::ATOM);
	}
	
	/**
	 * Sets the date to simple readable date.
	 * @param String $aStrDate
	 * @return String
	 */
	static public function PrettyDateFormat($aStrDate)
	{
		$intDate = strtotime($aStrDate);	
		return date('l, jS \o\f F Y \@ h:i:s a', $intDate);
	}
}