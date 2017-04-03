<?php
/*
 *	Class Routing - Handles the route process to determine what page to load based on the entered URL by user
 */
class Routing{

	/*
	 * define our properties needed
	 */
	protected $pObjRoute;
	
	/*
	 * constructor, initialise Routing
	 * @param Object
	 */
	public function __construct(Route $aObjRoute)
	{
		$this->pObjRoute = $aObjRoute;
	}
	
	/*
	 * Get route handler, basically a way to determine which controller is assigned to it
	 * @return Array
	 */	
	public function GetRoute()
	{
		$arrRoutes = $this->pObjRoute->GetRoutes();
		$strPage = $this->GetUri();
		$arrHandler = Utils::GetValueByIndex($strPage, $arrRoutes, null);
		return $arrHandler;
	}
	
	/*
	 * Get current URI, process which page is visited by user
	 * @return Strin
	 */	
	private function GetUri()
	{
		$strScriptName = Utils::GetValueByIndex('SCRIPT_NAME', $_SERVER, '');
		$strBasePath = implode('/', array_slice(explode('/', $strScriptName), 0, -1)) . '/';
		
		$strRequestUri = Utils::GetValueByIndex('REQUEST_URI', $_SERVER, '');
		$strUri = substr($strRequestUri, strlen($strBasePath));
		
		if (strstr($strUri, '?')) 
		{
			$strUri = substr($strUri, 0, strpos($strUri, '?'));
		}
		
		$strUri = '/' . trim($strUri, '/');
		return $strUri;
	}
}

