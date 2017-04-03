<?php

/*
 *	Class RequestParameters - Handles the creation of API URL that will be used by Class CurlRequest which handles the Curl Call to get the data we need
 */

class RequestParameters{
	
	/*
	 * define our properties needed
	 */
	private $pStrUrl;
	private $pStrNamespace;
	private $pStrCollection;
	private $pIntId;
	private $pStrRequestType;
	private $pStrFieldsCriteria;
	
	/*
	 * constructor, initialise RequestParameters
	 * @param String, String, String, Mixed, String, String
	 */
	public function __construct($aStrUrl, $aStrNamespace, $aStrCollection, $aIntId, $aStrRequestType, $aStrFieldsCriteria)
	{
        $this->pStrUrl = $aStrUrl;
		$this->pStrNamespace = $aStrNamespace;
		$this->pStrCollection = $aStrCollection;
		$this->pIntId = $aIntId;
		$this->pStrRequestType = $aStrRequestType;
		$this->pStrFieldsCriteria = $aStrFieldsCriteria;
    }
	
	/*
	 * Get the API URL
	 * @return String
	 */
	public function getUrl()
	{
		return $this->pStrUrl;
	}
	
	/*
	 * Get the Namespace that will be used in API call request
	 * @return String
	 */
	public function getNamespace()
	{
		return $this->pStrNamespace;
	}
	
	/*
	 * Get the Collection for the type of request needed
	 * @return String
	 */
	public function getCollection()
	{		
		return $this->pStrCollection;
	}
	
	/*
	 * Get the Id of a specific request if needed
	 * @return Mixed
	 */
	public function getId()
	{		
		return $this->pIntId;
	}
	
	/*
	 * Get the request type, currently the application only accept GET for querying the data in the API Request
	 * @return String
	 */
	public function getRequestType()
	{
		return $this->pStrRequestType;
	}
	
	
	/*
	 * Get the criteria for the search
	 * @return String
	 */
	public function getFieldsCriteria()
	{
		return $this->pStrFieldsCriteria;
	}
}