<?php
/*
 *	Class SearchModel - handles data process part for displaying search result
 */
Class SearchModel{

	/*
	 * define our properties needed
	 */
	private $pArrOutputData;
	private $pArrCriteria;
	
	/*
	 * constructor, initialise SearchModel criteria
	 * @param Array
	 */
	public function __construct($aArrCriteria)
	{
		$this->pArrCriteria = $aArrCriteria;
	}
	
	/*
	 * This function handles the Curl Request to get the data we need from the API URL
	 * 
	 */
	public function ProcessData()
	{
		$this->pArrCriteria[Constants::UNDERSCORE_EMBED] = true;
		
		$strBeforeDate = Utils::GetValueByIndex(Constants::BEFORE, $this->pArrCriteria, '');
		if ('' == trim($strBeforeDate))
		{
			unset($this->pArrCriteria[Constants::BEFORE]);
		}
		else
		{
			$this->pArrCriteria[Constants::BEFORE] = Utils::DateCompliantFormat( date(DATE_ISO8601, strtotime($strBeforeDate .  " +1 day" )));
		}
		
		$strAfterDate = Utils::GetValueByIndex(Constants::AFTER, $this->pArrCriteria, '');
		if ('' == trim($strAfterDate))
		{
			unset($this->pArrCriteria[Constants::AFTER]);
		}
		else
		{
			$this->pArrCriteria[Constants::AFTER] = Utils::DateCompliantFormat( date(DATE_ISO8601, strtotime($strAfterDate)));
		}
		
		$this->pArrCriteria[Constants::UNDERSCORE_EMBED] = true;
		
		/*
		 *	default data, where do we search in collection
		 */
		$arrCollections = array(
			Constants::COLLECTION_POSTS,
		);
		
		$arrCollectionsInPost = Utils::GetValueByIndex(Constants::COLLECTION, $this->pArrCriteria, $arrCollections);
				
		if (0 < count($arrCollectionsInPost))
		{
			$arrCollections = $arrCollectionsInPost;
		}
		//unset the collection field in the criteria, not needed in API call parameter
		unset($this->pArrCriteria[Constants::COLLECTION]);
		
		$strRequestType = Constants::REQUEST_TYPE_GET;
		$strPostFieldsQuery = http_build_query($this->pArrCriteria);
		$strUrl = API_URL;
		$strNameSpace = API_NAMESPACE;
		$intPostId = -1;
		
		foreach($arrCollections as $strCollection)
		{			
			$objRequestParameters = new RequestParameters($strUrl, $strNameSpace, $strCollection, $intPostId, $strRequestType, $strPostFieldsQuery);
			$objCurlRequest = new CurlRequest($objRequestParameters);
			if (true == $objCurlRequest->SendRequest())
			{
				$this->pArrOutputData[$strCollection] = $objCurlRequest->GetOutput();
			}
		}
	}
	
	/*
	 * Gets the result of the CURL Request on the API
	 * @return Array
	 */
	public function GetOutput()
	{
		return $this->pArrOutputData;
	}


}