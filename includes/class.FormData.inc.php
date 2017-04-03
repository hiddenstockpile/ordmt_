<?php
/*
 *	Class FormData - manages data that are posted from a form, we can add data process and validations here
 */

class FormData{

	/*
	 * define our properties needed
	 */
	private $pArrFormData;
	
	/*
	 * constructor, initialise FormData
	 * @param Array
	 */
	public function __construct($aArrPostData)
	{
		$this->pArrFormData = $aArrPostData;
	}
	
	/*
	 * Get the field value by index
	 * @return Mixed
	 */	
	public function GetDataByField($aStrFieldName)
	{
		return Utils::GetValueByIndex($aStrFieldName, $this->pArrFormData, '');
	}

}
