<?php
/*
 *	Class ShowPostModel - handles data process part for displaying a single post
 */
Class ShowPostModel{

	/*
	 * define our properties needed
	 */
	private $pArrOutputData;
	private $pArrCriteria;
	
	/*
	 * constructor, initialise ShowPostModel criteria
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
		
		$intPostId = Utils::GetValueByIndex(Constants::ID, $this->pArrCriteria, -1);
		unset($this->pArrCriteria[Constants::ID]);
		
		/*
		 *	where do we search in collection
		 */
		$arrCollections = array(
			Constants::COLLECTION_POSTS,
		);
		
		//unset the collection field in the criteria, not needed in API call parameter
		unset($this->pArrCriteria[Constants::COLLECTION]);
		
		$strRequestType = Constants::REQUEST_TYPE_GET;
		$strPostFieldsQuery = http_build_query($this->pArrCriteria);
		$strUrl = API_URL;
		$strNameSpace = API_NAMESPACE;
		
		
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