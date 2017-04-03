<?php
/*
 *	Class CurlRequest - handles the curl request feature of the application
 */

class CurlRequest extends Utils{
	
	/*
	 * define our properties needed
	 */
	private $pOutput;
	private $pCurlInfo;
	private $pObjRequestParameters;
	private $pStrRequestTypeGET = 'GET';
	private $pStrRequestTypePOST = 'POST';
	
	/*
	 * constructor, initialise CurlRequest Properties
	 * @param Object
	 */
	public function __construct(RequestParameters $aObjRequestParameters)
	{
		$this->pObjRequestParameters = $aObjRequestParameters;
    }
	
	/*
	 * This will send the request on the API via CURL function of PHP
	 * @return mixed
	 */
	public function SendRequest()
	{
		// 1. initialise curl
		$ch = curl_init();
		
		// 2. set the options, including the url
		$strUrl = $this->pObjRequestParameters->getUrl();
		
		$strNamespace = $this->pObjRequestParameters->getNamespace();
		if ('' != trim($strNamespace))
		{
			$strUrl .= '/' . $strNamespace;
		}
		
		$strCollection = $this->pObjRequestParameters->getCollection();
		if ('' != trim($strCollection))
		{
			$strUrl .= '/' . $strCollection;
		}
		
		/*
		 * Set id for querying specific data by id from the collection
		 */
		$intId = $this->pObjRequestParameters->getId();
		if (0 < $intId)
		{
			$strUrl .=  '/' . $intId;
		}
		
		/*
		 * We can send POST data for update purposes
		 */
		$strRequestType = $this->pObjRequestParameters->getRequestType();
		if ($this->pStrRequestTypeGET == $strRequestType)
		{
			$strUrl .= '?' . $this->pObjRequestParameters->getFieldsCriteria();
		}
		
		/*
		 * We can send POST data for UPDATE requests
		 */
		if ($this->pStrRequestTypePOST == $strRequestType)
		{
			$strFieldsCriteria = $this->pObjRequestParameters->getFieldsCriteria();
			curl_setopt($ch, CURLOPT_POSTFIELDS, $strFieldsCriteria);
		}
		
		curl_setopt($ch, CURLOPT_URL, $strUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		
		/*
			- we set custom method for update since wp-api requires POST to update, GET on access data
		*/
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->pObjRequestParameters->getRequestType());
		
		//set curl info just in case we need it
		$this->pCurlInfo = curl_getinfo($ch);
		
		// 3. execute and get the output
		$output = curl_exec($ch);
	 
		// 4. free up the curl handle
		curl_close($ch);
	
		$this->pOutput = $output;
		return $this->CheckOutput();
		
	}
	
	/*
	 * Adds check on the returned output of the CURL request
	 * @return mixed
			- 404 : the API url is not working or is not accessible
			- true : the request was successful and return 
	 */
	private function CheckOutput()
	{
		$output = $this->GetOutput();
		$arrData = $this->GetValueByIndex($this->DATA, $output, null);
		if (null != $arrData)
		{
			$intStatus = $this->GetValueByIndex($this->STATUS, $arrData, 404);
			if ('404' == $intStatus || 404 == $intStatus)
			{
				return 404;
			}
		}
		
		return true;
	}
	
	/*
	 * Get the result output of the CURL request from the API Url
	 * @return Array
	 */
	public function GetOutput($aBoolDecodeOutput = true)
	{
		if (true == $aBoolDecodeOutput)
		{
			return json_decode($this->pOutput, true);
		}
		
		return $this->pOutput;
	}

	/*
	 * Get CURL Request Information
	 * @return Array
	 */
	public function getCurlInfo()
	{
		return $this->pCurlInfo;
	}
}
